<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Login</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Error, unable to connect with these credentials.</p>
                </div>
                <form @submit.prevent="login()">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input v-model="email" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="card-footer"><a href="/social/login/github">
                <i class="fa fa-2x fa-github" aria-hidden="true"></i> Login with github</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                has_error: false
            }
        },
        methods: {
            login(token) {
                var data = {};
                if (token) {
                    data = {
                        token: token
                    };
                } else {
                    data = {
                        email: app.email,
                        password: app.password
                    };
                }
                var app = this;
                this.$auth.login({
                    params: data,
                    success: function () {
                        this.redirect();
                    },
                    error: function () {
                        app.has_error = true
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
            redirect() {
                var redirect = this.$auth.redirect();
                const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'home';
                this.$router.push({name: redirectTo})
            },
            loginByToken() {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('loginToken')) {
                    console.log('here');
                    this.login(urlParams.get('loginToken'));
                }
            }
        },
        mounted() {
            this.loginByToken();
        }
    }
</script>
