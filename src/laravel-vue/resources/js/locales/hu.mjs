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
    settings: {
        menu: {
            yourProfile: "Profilod",
            yourAccount: "Fiókod",
            language: "Nyelv",

            profile: {
                username: "Felhasználónév",
                email: "Email",
                update: "Frissítés",
                loading: "Betöltés",
                validation: {
                    email: "Ez nem email nem valid !",
                    min: "Minimum {n} betűnél nagyobb legyen.",
                    max: "Maxinum {n} karakter hosszú lehet.",
                    required: "Kötelező kitölteni !",
                }
            },
            password: {
                title: "Jelszó visszaállítás",
                current_password:"Régi jelszó",
                password_changed: "Új jelszó",
                password_changed_confirm: "Új jelszó megerösités",
                update: "Frissítés",

                validation: {
                    min: "Minimum {n} betűnél nagyobb legyen.",
                    max: "Maxinum {n} karakter hosszú lehet.",
                    required: "Kötelező kitölteni !",
                    passwordAreNotTheSame: "A jelszavak nem egyeznek meg !",
                    oldPasswordAndNewPasswordSame: "Régi és új jelszó nem lehet ugyan az !"

                }
            },
            logoutAll: {
                title: "Kijelentkezés minden fiókból",
                button: "Kijelentkezés",

                model: {
                    questionTitle: "Kijelentkezés minden fiókból ?",
                    questionAreYouSure: "Biztos vagy ebben ?",
                    yesImSure: "Igen !",
                    close: "Bezárás"
                }
            },
            deleteAccount: {
                title: "Veszélyzona",
                deleteTheAccount: "Fiók törlése",
                thisActionIs:"Ez a tevékenység",
                notReversible: "nem visszafordítható",
                button: "Fiók Törlése",

                model: {
                    questionTitle: "Fiók törlése ?",
                    thisActionIsNotReversible: "Ez a tevékenység nem visszafordítható !",
                    questionAreYouSure: "Biztos vagy ebben ?",
                    yesImSure: "Igen !",
                    close: "Bezárás"
                }
            }
        }
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

        },
        username: {
            success: "Felhsználónév sikeresen frissitve !"
        },
        email: {
            success: "Email sikeresen frissitve !",
            taken: "Ez az email már foglalt !"
        },
        password: {
            success: "Jelszó sikeresen frissitve !",
            wrongPassword: "Rossz régi jelszó !",
        },
        accountDelete: {
            success: "Felhasználó sikeresen törölve !"
        }
    }
}
