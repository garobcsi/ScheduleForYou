<template>
    <div class="container-fluid">
        <div class="row">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h1 class="display-4 mb-4">Welcome to Schedule For You!</h1>
                        <p class="lead">Schedule For You is a versatile and user-friendly application designed to simplify your daily scheduling needs. The application is built to provide users with an easy-to-use platform to manage their schedules effectively. With Schedule For You, you can easily organize your personal and professional appointments in one convenient location.</p>
                    </div>
                </div>

                <div class="row justify-content-center my-5">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="mb-4">Features</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>Easily manage personal and professional appointments</li>
                                    <li>Set reminders and notifications for upcoming events</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>View your schedule in daily, weekly, or monthly formats</li>
                                    <li>Intuitive and user-friendly interface</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="mb-4">Get Started</h2>
                        <p class="lead mb-5">To get started, simply create an account and log in to Schedule For You. From there, you can start adding appointments and events to your schedule. You can also customize your settings and preferences to best suit your needs.</p>
                        <router-link to="/signup" class="btn btn-primary me-3">Sign Up</router-link>
                        <router-link to="/login" class="btn btn-outline-primary">Log In</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>

h1.display-4 {
    color: #007bff;
}

ul.list-unstyled {
    text-align: left;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
</style>
