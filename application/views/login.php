    <?php require('template/header.php'); ?>
    <title>Login</title>
</head>
<body>
    <div id="app">
        <v-app>
            <v-content>
                <v-layout align-center fill-height>
                    <v-container fluid>
                        <v-row align="center" justify="center">
                            <v-col cols="12" sm="8" md="4">
                                <v-card class="elevation-12" :disabled="loading">
                                    <v-toolbar color="blue" flat>
                                        <v-toolbar-title v-if="!registerForm">Login</v-toolbar-title>
                                        <v-toolbar-title v-else>Register</v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        <span class="red--text">{{errorMessage}}</span>
                                    </v-toolbar>
                                    <v-card-text>
                                        <v-form ref="form">
                                            <v-text-field
                                                v-if="!registerForm"
                                                v-model="user.nomor"
                                                v-on:keyup.enter="login"
                                                label="NIM"
                                                :rules="rules.nomor"
                                            ></v-text-field>
                                            <v-text-field
                                                v-else
                                                v-model="user.nomor"
                                                v-on:keyup.enter="register"
                                                label="NIM"
                                                :rules="rules.nomor"
                                            ></v-text-field>
                                            <v-text-field
                                                v-if="registerForm"
                                                v-model="user.nama"
                                                v-on:keyup.enter="register"
                                                label="Nama Lengkap"
                                                :rules="rules.nama"
                                            ></v-text-field>
                                            <v-text-field
                                                v-if="!registerForm"
                                                v-model="user.password"
                                                v-on:keyup.enter="login"
                                                label="Password"
                                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                :type="showPassword ? 'text' : 'password'"
                                                @click:append="showPassword = !showPassword"
                                                :rules='rules.password'
                                            ></v-text-field>
                                            <v-text-field
                                                v-else
                                                v-model="user.password"
                                                v-on:keyup.enter="register"
                                                label="Password"
                                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                :type="showPassword ? 'text' : 'password'"
                                                @click:append="showPassword = !showPassword"
                                                :rules='rules.password'
                                            ></v-text-field>
                                        </v-form>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-btn v-if="!registerForm" text color="orange lighten-2" class="mt-n7 mb-2 mr-1 body-2" @click="showRegisterForm" style="text-transform: none">
                                            Register Here
                                        </v-btn>
                                        <v-btn v-else text color="orange lighten-2" class="mt-n7 mb-2 mr-1 body-2" @click="registerForm = false" style="text-transform: none">
                                            Punya Akun? Login
                                        </v-btn>
                                        <v-spacer></v-spacer>
                                        <v-btn v-if="!registerForm" color="blue" class="mt-n7 mb-2 mr-1" @click="login">
                                            <span v-if="loading">
                                                <v-progress-circular size="20" :indeterminate="loading"></v-progress-circular>
                                            </span>
                                            <span v-else class="body-2">Login</span>
                                        </v-btn>
                                        <v-btn v-else color="blue" class="mt-n7 mb-2 mr-1" @click="register">
                                            <span v-if="loading">
                                                <v-progress-circular size="20" :indeterminate="loading"></v-progress-circular>
                                            </span>
                                            <span v-else class="body-2">Register</span>
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-layout>
                <v-snackbar
                    v-model="snackbar"
                    multi-line
                    v-bind:color="snackbarColor"
                >
                    {{ snackbarMessage }}
                    <v-btn
                        text
                        @click="snackbar = false"
                    >
                        <v-icon>
                            mdi-close
                        </v-icon>
                    </v-btn>
                </v-snackbar>
            </v-content>
        </v-app>
    </div>

    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),

            created() { 
                this.$vuetify.theme.dark = true
            },

            data() {
                return {
                    user: {
                        nomor:'',
                        nama:'',
                        password:''
                    },
                    rules: {
                        nomor: [
                            v => !!v || 'nomor Wajib diisi',
                            v => /^[0-9]*$/.test(v) || 'nomor Harus berupa angka'
                        ],
                        password: [
                            v => !!v || 'Password Wajib diisi',
                        ],
                        nama: [
                            v => !!v || 'Nama Wajib diisi',
                            v => v.length > 4 || 'Nama Tidak Valid'
                        ]
                    },
                    showPassword: false,
                    registerForm: false,
                    logInstatus: false,
                    loading: false,
                    errorMessage: '',
                    snackbar: false,
                    snackbarMessage: '',
                    snackbarColor: '',
                }
            },

            methods: {
                showRegisterForm() {
                    this.registerForm = true
                },
                register() {
                    if(this.$refs.form.validate()) {
                        this.loading = true
                        return new Promise((resolve, reject) => {
                            axios.post('<?= base_url()?>api/User_Login', this.user)
                            .then(response => {
                                resolve(response.data)
                            }) .catch(err => {
                                if(err.response.status == 500) reject(err.response.data)
                                if(err.response.status == 401) reject(err.response.data)
                            })
                        })
                        .then((response) => {
                            this.snackbarColor = 'success'
                            this.snackbarMessage = response.message
                        }) .catch(err => {
                            this.snackbarColor = 'error'
                            this.snackbarMessage = err.message
                        }) .finally(() => {
                            this.snackbar = true
                            this.loading = false
                        })
                    }
                },
                login() {
                    if(this.$refs.form.validate()) {
                        this.loading = true
                        return new Promise((resolve, reject) => {
                            axios.get('<?= base_url()?>api/User_Login', {params: {nomor: this.user.nomor, password: this.user.password}})
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                    if(err.response.status == 401) reject(err.response.data)
                                })
                        })
                        .then((response) => {
                            this.errorMessage = ''
                            this.logInstatus = true
                        }) .catch(err => {
                            if(err.message == "User Not Found" || err.message == "Incorrect Password") {
                                this.errorMessage = err.message
                            } else {
                                if(err.message == "User belum diverifikasi oleh admin") {
                                    this.snackbarMessage = err.message
                                    this.snackbarColor = 'error'
                                    this.snackbar = true
                                } else {
                                    this.snackBarMessage = err
                                    this.snackBarColor = 'error'
                                    this.snackbar = true
                                }
                            }
                        }) .finally(() => {
                            if(this.logInstatus) {
                                window.location.href = '<?=base_url('Home');?>'
                            } else {
                                this.loading = false
                            }
                        })
                    }
                }
            }
        })
    </script>
</body>