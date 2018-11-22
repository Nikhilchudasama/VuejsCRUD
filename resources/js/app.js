
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import axios from 'axios';

const app = new Vue({
    el: '#takContainer',
    data: {
        task: {
            name: '',
            description: ''
        },
        errors: [],
        tasks: [],
        update_task: {}

    },
    methods: {
        readTasks(){
            axios.get('/task')
            .then(response => {
                this.tasks = response.data.tasks;
            });
        },
        initAddTask()
        {
            $("#add_task_model").modal("show");
        },
        createTask()
        {
                axios.post('/task', {
                    title: this.task.title,
                    description: this.task.description,
                })
                .then(response => {
                    this.reset();
                    this.tasks.push(response.data.task);
                    $("#add_task_model").modal("hide");
                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.title) {
                        this.errors.push(error.response.data.errors.title[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
        },
        reset()
        {
            this.task.name = '';
            this.task.description = '';
        },
        initUpdate(index)
        {
            this.errors = [];
            $("#update_task_model").modal("show");
            this.update_task = this.tasks[index];
        },
        updateTask()
        {
            axios.patch('/task/' + this.update_task.id, {
                title: this.update_task.title,
                description: this.update_task.description,
            })
            .then(response => {
                $("#update_task_model").modal("hide");
            })
            .catch(error => {
                this.errors = [];
                if (error.response.data.errors.title) {
                    this.errors.push(error.response.data.errors.title[0]);
                }

                if (error.response.data.errors.description) {
                    this.errors.push(error.response.data.errors.description[0]);
                }
            });
        },
        deleteTask(index)
        {
            let conf = confirm("Do you ready want to delete this task?");
            if (conf === true) {
                axios.delete('/task/' + this.tasks[index].id)
                .then(response => {
                    this.tasks.splice(index, 1);
                })
                .catch(error => {
                });
            }
        }
    },
    created: function () {
        axios.get('/task')
        .then(response => {
            app.tasks = response.data.tasks;
        });
    },
});
