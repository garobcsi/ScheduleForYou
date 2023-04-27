export default {
    placeholder: "Nincs forditás. (i18n)",
    navbar: {
        home: 'Kezdőlap',
        services: 'Szolgáltatások',
        explore: "Felfedezés",

        button: {
            register: "Regisztráció",
            login:"Bejelenkezés"
        },
        dropdown: {
            logedInAs: "Bejelentkezve mint",
            adminPage: "Admin oldal",
            profile: "Profilod",
            companies: "Cégeid",
            settings:"Bállitások",
            logOut:"Kijelentkezés"
        }
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
    login: {
        title: "Bejelentkezés",
        form: {
            email: "Email",
            password: "Jelszó",
            stayLogedIn: "Bejelentkezve maradok.",

            button: {
                login: "Bejelentkezés"
            },
            validation: {
                email: "Ez nem email nem valid !",
                required: "Kötelező kitölteni !",
            },
            error: {
                youAreAlreadyLogedIn: "Már bevagy jelentkezve !",
                userOrPasswordWrong: "A felhasználónév vagy jelszó rossz !",
            }
        },

    },
    toast: {
        error: "Váratlan hiba történt !",
        register: {
            success: "Sikeres regisztráció !",
        },
        login: {
            success: "Sikeres bejelentkezés !"
        },
        logout: {
            account: 'Sikeres kijelentkezés !',
            accountAll: 'Sikeres kijelentkezés !'

        }
    }
}
