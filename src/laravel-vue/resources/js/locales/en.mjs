export default {
    placeholder: "No translation. (i18n)",
    navbar: {
        home: 'Home',
        services: 'Services'
    },
    locale: {
        en: 'English',
        hu: 'Magyar'
    },
    register: {
        title: "Registration",
        form: {
            username: "Username",
            email:"Email",
            password:"Password",
            passwordConfirm: "Confirm Password",

            button: {
                register:"Register",
            },

            validation: {
                min: "Must be greater than {n} letters.",
                max: "It can be a maximum of {n} characters long.",
                password: "The password cannot be smaller than {n} characters !",
                required: "Required to fill out !",
                email: "This email is not valid !",
                passwordAndUsernameSame: "The username and password can't be the same !",
                passwordAreNotTheSame: "The password don't match !",
            },
            error: {
                thisEmailExists: "This email is already in use !",

            }
        },
    },
    toast: {
        error: "Unexpected error occurred !",
        register: {
            success: "Registration success !",
        }
    }
}
