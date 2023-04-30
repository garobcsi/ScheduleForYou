export default {
    placeholder: "No translation. (i18n)",
    navbar: {
        home: 'Home',
        services: 'Services',
        explore: "Explore",

        button: {
            register: "Registration",
            login:"Login"
        },
        dropdown: {
            logedInAs: "Loged in as",
            adminPage: "Admin page",
            profile: "Your Profile",
            companies: "Your Companies",
            settings:"Settings",
            logOut:"Log out"
        }
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
    login: {
        title: "Login",
        form: {
            email: "Email",
            password: "Password",
            stayLogedIn: "Stay Loged In",

            button: {
                login: "Login"
            },
            validation: {
                email: "This email is not valid !",
                required: "Required to fill out !",
            },
            error: {
                youAreAlreadyLogedIn: "You are already loged in !",
                userOrPasswordWrong: "Email or Password wrong !",
            }
        },

    },
    settings: {
        menu: {
            yourProfile: "Your Profile",
            yourAccount: "Your Account",
            language: "Language",

            profile: {
                username: "Username",
                email: "Email",
                update: "Update",
                loading: "Loading",

                validation: {
                    email: "This email is not valid !",
                    max: "It can be a maximum of {n} characters long.",
                    min: "Must be greater than {n} letters.",
                    required: "Required to fill out !",
                }
            },
            password: {
                title: "Password reset",
                current_password:"Old Password",
                password_changed: "New Password",
                password_changed_confirm: "Confirm New Password",
                update: "Update",

                validation: {
                    max: "It can be a maximum of {n} characters long.",
                    min: "Must be greater than {n} letters.",
                    required: "Required to fill out !",
                    passwordAreNotTheSame: "The password don't match !",
                    oldPasswordAndNewPasswordSame: "Old and New password cannot be the same !"
                }
            }
        }
    },
    toast: {
        error: "Unexpected error occurred !",
        register: {
            success: "Registration success !",
        },
        login: {
            success: "Login Success !"
        },
        logout: {
            account: 'Logout Success !',
            accountAll: 'Loged Out of all devices !'
        },
        username: {
            success: "Username successfully updated !"
        },
        email: {
            success: "Email successfully updated !",
            taken: "The email has already been taken !"
        },
        password: {
            success: "Password successfully updated !",
            wrongPassword: "Wrong old password !",
        }
    }
}
