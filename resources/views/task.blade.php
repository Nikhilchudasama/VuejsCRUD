@extends('welcome')

@section('content')
<div class="container" id="takContainer">
    <h3 class="text-center mb-4 mt-5">Task Application</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button v-on:click="initAddTask()" class="btn btn-primary btn-xs float-right">
                        + Add New Task
                    </button>
                    My Tasks
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped " v-if="tasks.length > 0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(task, index) in tasks">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ task.title }}</td>
                                <td>@{{ task.description }}</td>
                                <td>
                                    <button v-on:click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button v-on:click="deleteTask(index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Task</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Title:</label>
                            <input type="text" name="title" id="title" placeholder="Task Title" class="form-control"
                                   v-model="task.title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="task.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" v-on:click="createTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Task</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for-key="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" placeholder="Task title" class="form-control"
                                   v-model="update_task.title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="update_task.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" v-on:click="updateTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

</div>
@endsection