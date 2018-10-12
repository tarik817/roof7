<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Registration</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'validation_error'">Validation error (s), please consult the message (s)
                        below.</p>
                    <p v-else>Error, can not register for the moment. If the problem persists, please contact an
                        administrator.</p>
                </div>
                <form autocomplete="off" @submit.prevent="registerUser()" v-if="!success">
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                        <label for="register-nickname">Nickname</label>
                        <input v-model="name" type="text" class="form-control" id="register-nickname"
                               aria-describedby="register-nickname-help" placeholder="Nickname">
                        <small id="register-nickname-help" class="form-text text-muted">Chose your nickname</small>
                        <span class="help-block" v-if="has_error && errors.name">{{ errors.name[0] }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="register-email">Email address</label>
                        <input v-model="email" type="email" class="form-control" id="register-email"
                               aria-describedby="register-email-help" placeholder="Enter email">
                        <small id="register-email-help" class="form-text text-muted">We'll never share your email with
                            anyone else.
                        </small>
                        <span class="help-block" v-if="has_error && errors.email">{{ errors.email[0] }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="exampleInputPassword1">Password</label>
                        <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password[0] }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="register-password-confirmation">Password Confirmation</label>
                        <input v-model="password_confirmation" type="password" class="form-control"
                               id="register-password-confirmation" placeholder="Password Confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },
        methods: {
            registerUser() {
                var app = this;
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.success = true;
                        this.$router.push({
                            name: 'user.login',
                            params: {
                                successRegistrationRedirect: true
                            }
                        });
                    },
                    error: function (res) {
                        app.has_error = true;
                        app.error = res.response.data.status;
                        app.errors = res.response.data.errors || {}
                    }
                })
            }
        }
    }
</script>
