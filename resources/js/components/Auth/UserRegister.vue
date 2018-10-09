<template>
    <div class="container">
        <form @submit.prevent="registerUser">
            <div class="form-group">
                <label for="register-nickname">Nickname</label>
                <input v-model="register.name" type="text" class="form-control" id="register-nickname" aria-describedby="register-nickname-help" placeholder="Nickname">
                <small id="register-nickname-help" class="form-text text-muted">Chose your nickname</small>
            </div>
            <div class="form-group">
                <label for="register-email">Email address</label>
                <input v-model="register.email" type="email" class="form-control" id="register-email" aria-describedby="register-email-help" placeholder="Enter email">
                <small id="register-email-help" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="register.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="register-password-confirmation">Password Confirmation</label>
                <input v-model="register.password_confirmation" type="password" class="form-control" id="register-password-confirmation" placeholder="Password Confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                register: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            }
        },
        methods: {
            registerUser() {
                axios.post('/api/register', this.register)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        }
    }
</script>
