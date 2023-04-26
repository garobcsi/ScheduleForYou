export default {
    placeholder: "Nincs forditás. (i18n)",
    navbar: {
        home: 'Kezdőlap',
        services: 'Szolgáltatások'
    },
    locale: {
        en: 'English',
        hu: 'Magyar'
    },
    register: {
        title: "Regisztráció",
        form: {
            username: "Felhasználónév",
            email:"Email",
            password:"Jelszó",
            passwordConfirm: "Jelszó Megerősítés",

            button: {
                register:"Regisztráció",
            },

            validation: {
                min: "Minimum {n} betűnél nagyobb legyen.",
                max: "Maxinum {n} karakter hosszú lehet.",
                password: "A jelszó {n} betünél kisebb nem lehet !",
                required: "Kötelező kitölteni !",
                email: "Ez nem email nem valid !",
                passwordAndUsernameSame: "A jelszó és felhazsnálónév nem lehet ugyan az !",
                passwordAreNotTheSame: "A jelszavak nem egyeznek meg !",
            },
            error: {
                thisEmailExists: "Ez az email már foglalva van !",

            }
        },
    },
    toast: {
        error: "Váratlan hiba történt !",
        register: {
            success: "Sikeres regisztráció !",
        }
    }
}
