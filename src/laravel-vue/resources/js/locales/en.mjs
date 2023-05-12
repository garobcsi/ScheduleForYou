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
            yourCalendar: "Your Calendar",
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
                passwordAreNotTheSame: "The password doesn't match !",
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
            stayLogedIn: "Stay Logged In",

            button: {
                login: "Login"
            },
            validation: {
                email: "This email is not valid !",
                required: "Required to fill out !",
            },
            error: {
                youAreAlreadyLogedIn: "You are already logged in !",
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
                    passwordAreNotTheSame: "The password doesn't match !",
                    oldPasswordAndNewPasswordSame: "Old and New passwords cannot be the same !"
                }
            },
            logoutAll: {
                title: "Logout from all devices",
                button: "Logout All",

                model: {
                    questionTitle: "Logout from all devices ?",
                    questionAreYouSure: "Are you sure ?",
                    yesImSure: "Yes I'm sure !",
                    close: "Close"
                }
            },
            deleteAccount: {
                title: "Danger Zone",
                deleteTheAccount: "Delete the account",
                thisActionIs:"This action is",
                notReversible: "not reversible",
                button: "Delete account",

                model: {
                    questionTitle: "Delete the account ?",
                    thisActionIsNotReversible: "This action is not reversible !",
                    questionAreYouSure: "Are you sure ?",
                    yesImSure: "Yes I'm sure !",
                    close: "Close"

                }
            }
        }
    },
    calendar: {
        addDateModel: {
            titleDate: "Add Date",
            titleRoutine: "Add Routine",
            select: {
                date: "Date",
                routine: "Routine",
            },
            form: {
                name: "Name",
                startDate: "Start Date",
                endDate:"End Date",
                startRoutine: "Start Routine",
                endRoutine: "End Routine",
                repeatTime: "Repeat Time",
                description: "Description",
                buttons: {
                    close:"Close",
                    save:"Save"
                },
                validation: {
                    max: "It can be a maximum of {n} characters long.",
                    dateError: "This is not a valid date !",
                    required: "Required to fill out !"
                }
            },
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
            accountAll: 'Logged Out of all devices !'
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
        },
        accountDelete: {
            success: "Account successfully deleted !"
        }
    },
    explore: {
        companies: "Already registered companies",
        card: {
            show:"Show the company"
        }
    },
    index: {
        title: {
            title:"Welcome to Schedule For You!",
            txt: "Schedule For You is a versatile and user-friendly application designed to simplify your daily scheduling needs. The application is built to provide users with an easy-to-use platform to manage their schedules effectively. With Schedule For You, you can easily organize your personal and professional appointments in one convenient location.",
        },
        feature: {
            title: "Features",
            txt: "Easily manage personal and professional appointments",
            txt1: "Set reminders and notifications for upcoming events",
            txt2: "View your schedule in daily, weekly, or monthly formats",
            txt3: "Intuitive and user-friendly interface",
        }
        getStarted: {
            title: "Get Started",
            txt: "To get started, simply create an account and log in to Schedule For You. From there, you can start adding appointments and events to your schedule. You can also customize your settings and preferences to best suit your needs."
            button: {
                register:"Register",
                logIn:"Login"
            }
        }
    }
}
