<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> 
        <!-- Scripts -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>        
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div id="app">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Input section -->
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" v-model="body" placeholder="Enter the todo details">
                              <div class="input-group-append">
                                <button class="btn btn-success" @click="add_task()">Add Task</button> 
                              </div>
                            </div>


                            <!-- Table section -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr v-for="(todo, index) in todos">
                                        <td>
                                            <span v-if='todo.is_completed'><strike>@{{ todo.body }}</strike></span>
                                            <span v-else>@{{ todo.body }}</span>
                                        </td>
                                            

                                        <td>
                                            <button class="btn btn-xs btn-success" @click="completed(todo)">Done</button>
                                            <button class="btn btn-xs btn-danger" @click="trash(todo, index)">Trash</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        

        const app = new Vue({
            el: '#app',
            data: {
                todos: [],
                body: ''
            },
            mounted() {
                
                axios.get('/todo')
                    .then(response => (this.todos = response.data));
            },
            methods: {

                add_task: function() {

                    // data = {
                    //     body: this.body,
                    //     age: this.age,
                    //     id:
                    //     created_
                    // }

                    axios.post('/todo', {body: this.body })
                        .then(response => {

                            alert('Data added');

                            this.todos.push(response.data);

                            this.body = '';

                        });

                },

                completed: function(todo) {
                    axios.put('/todo/'+todo.id, {is_completed: true })
                        .then(response => {

                            todo.is_completed = response.data.is_completed;
                            
                        });
                },

                trash: function(todo, index) {
                    
                    axios.delete('/todo/'+todo.id)
                        .then(response => {
                            
                            // check if the response from server is true and remove 
                            // that specific item from this.todos list
                            if(response.data == 'True') {
                                Vue.delete(this.todos, index);
                            }

                        }); 
                }



            }
        });

    </script>









</html>
