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
            yourCalendar: "Naptárod",
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
                title: "Veszélyzóna",
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
    calendar: {
        addDateModel: {
            titleDate: "Dátum hozzáadás",
            titleRoutine: "Rutin hozzáadás",
            select: {
                date: "Dátum",
                routine: "Rutin",
            },
            form: {
                name: "Név",
                startDate: "Kezdés dátuma",
                endDate:"Befejezés dátuma",
                startRoutine: "Kezdés Rutin dátuma",
                endRoutine: "Befejezés Rutin dátuma",
                repeatTime: "Ismétési idő",
                description: "Leírás",
                buttons: {
                    close:"Bezárás",
                    save:"Elmentés"
                },
                validation: {
                    max: "Maxinum {n} karakter hosszú lehet.",
                    dateError: "Ez a dátum nem valid !",
                    required: "Kötelező kitölteni !"
                }
            },
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
    },
    explore: {
        companies: "Már regisztrált cégek",
        card: {
            show:"Mutasd a céget"
        }
    },
    index: {
        title: {
            title:"Üdvözöljük a Schedule For You oldalon!",
            txt: "A Schedule For You egy sokoldalú és felhasználóbarát alkalmazás, amelynek célja a napi ütemezési igények egyszerűsítése. Az alkalmazás úgy készült, hogy a felhasználók számára könnyen használható platformot biztosítson az ütemezésük hatékony kezeléséhez. A Schedule For You segítségével könnyedén megszervezheti személyes és szakmai találkozóit.",
        },
        feature: {
            title: "Funkciók",
            txt: "Személyes és szakmai találkozók egyszerű kezelése",
            txt1: "Állítson be emlékeztetőket és értesítéseket a közelgő eseményekről",
            txt2: "Tekintse meg menetrendjét napi, heti vagy havi formátumban",
            txt3: "Intuitív és felhasználóbarát felület",
        },
        getStarted: {
            title: "Elindulás",
            txt: "A kezdéshez egyszerűen hozzon létre egy fiókot, és jelentkezzen be a Schedule For You szolgáltatásba. Innentől kezdve hozzáadhat találkozókat és eseményeket az ütemtervéhez. A beállításait és preferenciáit is testreszabhatja az igényeinek leginkább megfelelő módon.",
            button: {
                register:"Regisztráció",
                logIn:"Bejelentkezés"
            }
        }
    }
}
