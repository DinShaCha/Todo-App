<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="8" offset-lg="2" xl="6" offset-xl="3">
                <h1 class="mb-4">Add a task</h1>

                <oops-alert v-if="error" :error="error" />

                <v-row class="d-flex align-center mb-4" dense no-gutters>
                    <v-col>
                        <v-form @submit.prevent="addTask">
                            <v-text-field
                                v-model="newTaskTitle"
                                variant="solo"
                                style="height: 60px;"
                                :hide-details="true"
                                :placeholder="placeholder">
                                <template #append-inner>
                                    <v-btn
                                        type="submit"
                                        color="primary"
                                        variant="flat"
                                        rounded="false"
                                        class="rounded-s-0"
                                        style="height: 60px; margin-right: -.8em; margin-left: .8em;"
                                        size="large"
                                        @click="addTask">
                                        Add
                                        <v-icon icon="mdi-plus" class="ml-3"/>
                                    </v-btn>
                                </template>
                            </v-text-field>
                            <v-textarea
                                v-model="newTaskDescription"
                                variant="solo"
                                :placeholder="'Enter task description here'"
                                rows="3"
                                class="mt-4"
                            />
                        </v-form>
                    </v-col>
                </v-row>

                <v-card :loading="loadingTasks || sendingTask || deletingTasks">
                    <div v-if="loadingTasks">
                        <v-progress-linear indeterminate color="primary" />
                    </div>
                    <div v-else-if="tasks.length === 0" class="pa-6">
                        <p class="text-center font-weight-bold text-h6 mt-4 mb-2">Your todo list is still empty</p>
                    </div>
                    <div v-else>
                        <template v-for="task in tasks" :key="task.id">
                            <v-divider class="my-2" />

                            <v-row class="px-4 py-2" :style="{ 'background-color': task.completed ? '#e8f5e9' : 'transparent' }">
                                <v-col cols="11">
                                    <p class="font-weight-bold">{{ task.title }}</p>
                                    <p>{{ task.description }}</p>
                                </v-col>

                                <!-- Delete Button in the corner -->
                                <v-col cols="1" class="d-flex justify-end align-start">
                                    <v-btn
                                        color="green"
                                        variant="outlined"
                                        rounded
                                        @click="removeTask(task)"
                                        class="ml-2"
                                    >
                                        Done
                                    </v-btn>
                                </v-col>
                            </v-row>
                            <v-divider class="my-2" />
                        </template>

                        <div class="text-medium-emphasis text-right px-4 my-4">
                            {{ footerText }}
                        </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';
import OopsAlert from '@/components/OopsAlert.vue';
import { getRandomTaskName } from '../services/randomTaskName.js';

export default {
    components: {
        OopsAlert,
    },

    data() {
        return {
            loadingTasks: false,
            sendingTask: false,
            deletingTasks: false,
            error: null,
            newTaskTitle: '',
            newTaskDescription: '',
            tasks: [],
            placeholder: '',
        };
    },

    created() {
        this.placeholder = getRandomTaskName();
        this.refreshTasks();
    },

    computed: {
        isBusy() {
            return this.loadingTasks || this.sendingTask || this.deletingTasks;
        },

        footerText() {
            const total = this.tasks.length;
            const completed = this.tasks.filter(t => t.completed_at !== null).length;

            if (total === completed) {
                return 'All tasks completed';
            }

            return `${completed} of ${total} task${total === 1 ? '' : 's'} completed`;
        },
    },

  methods: {
    /**
     * Fetches the latest tasks and ensures only the most recent 5 are displayed.
     */
    async refreshTasks() {
        if (this.isBusy) return;

        this.loadingTasks = true;
        this.error = null;

        try {
            const response = await axios.get('/api/tasks');
            this.tasks = response.data.data
                .map(task => ({
                    ...task,
                    completed: task.completed_at !== null,
                }))
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at)) // Sort by newest first
                .slice(0, 5); // Keep only the latest 5
        } catch (e) {
            this.error = e;
        } finally {
            this.loadingTasks = false;
        }
    },

    /**
     * Adds a new task and refreshes the task list.
     */
async addTask() {
    if (this.isBusy) return;

    const title = this.newTaskTitle.trim();
    const description = this.newTaskDescription.trim();

    if (!title || !description) {
        this.error = new Error('Both title and description are required');
        return;
    }

    this.sendingTask = true;
    this.error = null;

    try {
        const { data } = await axios.post('/api/tasks', {
            title,
            description,
        });

        // Add the new task to the beginning of the list and keep only the latest 5
        this.tasks = [data, ...this.tasks].slice(0, 5);

        // Reset input fields
        this.newTaskTitle = '';
        this.newTaskDescription = '';
        this.placeholder = getRandomTaskName();
    } catch (e) {
        console.error(e);
        this.error = e;
    } finally {
        this.sendingTask = false;
    }
},

    /**
     * Removes a task and refreshes the task list.
     */
     async removeTask(task) {
            if (this.isBusy) return;

            this.deletingTasks = true;

            // Optimistically remove task from UI
            this.tasks = [...this.tasks.filter(t => t.id !== task.id)]; // Ensure reactivity trigger

            try {
                await axios.delete(`/api/tasks/${task.id}`);

                // Directly update the tasks list instead of refetching all
                const response = await axios.get('/api/tasks');
                this.tasks = response.data.data
                    .map(task => ({
                        ...task,
                        completed: task.completed_at !== null,
                    }))
                    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at)) // Sort by newest first
                    .slice(0, 5); // Keep only the latest 5
            } catch (e) {
                console.error(e);
                this.error = e;

                // If delete fails, re-add the task to prevent UI desync
                this.tasks.push(task);
            } finally {
                this.deletingTasks = false;
            }
        },

        async updateTask(task) {
            if (this.isBusy) return;

            this.sendingTask = true;
            try {
                const { data } = await axios.put(`/api/tasks/${task.id}`, {
                    completed: task.completed,
                    title: task.title,
                });

                const index = this.tasks.findIndex(t => t.id === task.id);
                this.tasks[index] = {
                    ...data,
                    completed: data.completed_at !== null,
                };
            } catch (e) {
                console.error(e);
                this.error = e;
            } finally {
                this.sendingTask = false;
            }
        },
    },
};
</script>
