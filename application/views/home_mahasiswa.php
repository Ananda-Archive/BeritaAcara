<?php require('template/header.php'); ?>
    <title>Home</title>
    </head>
	<body>
		<div id="app">
			<v-app>
				<?php require('template/navbar.php') ?>
				<v-content>
					<v-layout fill-height>
                        <v-container fluid>
                            <v-row align="center">
								<v-col cols="12" sm="12" md="3">
                                    <!-- Card Upload Berkas -->
                                    <v-card @click="uploadBerkasDialog = !uploadBerkasDialog" class="elevation-12 align-center" color="blue" min-height="230" max-height="230">
                                        <div class="d-flex flex-no-wrap justify-space-between">
											<div>
												<v-card-title class="font-weight-light">UPLOAD BERKAS</v-card-title>
											</div>
											<div>
												<v-card-title class="font-weight-light"><v-icon>mdi-clipboard-file</v-icon></v-card-title>
											</div>
										</div>
										<v-card-title class="justify-center"><v-icon class="display-4">mdi-file-plus</v-icon></v-card-title>
                                    </v-card>
                                    <!-- Dialog Upload Berkas -->
                                    <v-dialog v-model="uploadBerkasDialog" persistent max-width="1000px">
                                        <v-card>
                                            <v-toolbar dense flat color="blue">
                                                <span class="title font-weight-light">Upload Berkas</span>
                                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                            </v-toolbar>
                                            <v-card-text>
                                                <v-col cols='12' class='text-center mb-n12'>
                                                    <v-card-text class="red--text">--> FILE HARUS FORMAT PDF & UPLOAD HANYA BISA SEKALI <--</v-card-text>
                                                </v-col>
                                            </v-card-text>
                                            <v-card-text>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            v-model="uploadBerkas.toefl"
                                                            color="blue"
                                                            label="Berkas TOEFL"
                                                            placeholder="Select your file"
                                                            prepend-icon=""
                                                            outlined
                                                            accept="application/pdf"
                                                            class="mt-4"
                                                            :disabled="disabledOne"
                                                            :clearable="logoOne.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon @click="uploadOne" :disabled="uploadBerkas.toefl == null" :color="logoOne.color">{{logoOne.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            v-model="uploadBerkas.fileSkripsi"
                                                            color="blue"
                                                            label="Berkas Skripsi"
                                                            placeholder="Select your file"
                                                            prepend-icon=""
                                                            outlined
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                            :disabled="disabledTwo"
                                                            :clearable="logoTwo.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon @click="uploadTwo" :disabled="uploadBerkas.fileSkripsi == null" :color="logoTwo.color">{{logoTwo.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            v-model="uploadBerkas.bimbingan"
                                                            color="blue"
                                                            label="Kartu Bimbingan"
                                                            placeholder="Select your file"
                                                            prepend-icon=""
                                                            outlined
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                            :disabled="disabledThree"
                                                            :clearable="logoThree.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon @click="uploadThree" :disabled="uploadBerkas.bimbingan == null" :color="logoThree.color">{{logoThree.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            v-model="uploadBerkas.transkrip"
                                                            color="blue"
                                                            label="Transkrip Terbaik"
                                                            placeholder="Select your file"
                                                            prepend-icon=""
                                                            outlined
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                            :disabled="disabledFour"
                                                            :clearable="logoFour.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon @click="uploadFour" :disabled="uploadBerkas.transkrip == null" :color="logoFour.color">{{logoFour.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                            </v-card-text>
                                            <v-card-text>
                                                <v-col cols='12' class='mt-n12 text-center'>
                                                    <v-card-text class='mt-n6 red--text'>REFRESH PAGE JIKA GAGAL UPLOAD</v-card-text>
                                                </v-col>
                                            </v-card-text>
                                        </v-card>
                                    </v-dialog>
                                </v-col>
                                <!-- UPLOAD BERITA ACARA -->
                                <v-col cols='12' sm='12' md='3'>
                                    <v-card @click="uploadBeritaAcaraDialog = !uploadBeritaAcaraDialog" class="elevation-12 align-center" color="blue" min-height="230" max-height="230">
                                        <div class="d-flex flex-no-wrap justify-space-between">
											<div>
												<v-card-title class="font-weight-light">UPLOAD BERITA ACARA</v-card-title>
											</div>
											<div>
												<v-card-title class="font-weight-light"><v-icon>mdi-newspaper</v-icon></v-card-title>
											</div>
										</div>
										<v-card-title class="justify-center"><v-icon class="display-4">mdi-newspaper-plus</v-icon></v-card-title>
                                    </v-card>
                                </v-col>
                                <v-dialog persistent v-model="uploadBeritaAcaraDialog" max-width="700px">
                                    <v-card>
                                        <v-toolbar dense flat color="blue">
                                            <span class="title font-weight-light">Upload Berita Acara</span>
                                            <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card-text>
                                            <v-form ref='form'>
                                                <v-col cols='12'>
                                                    <v-menu
                                                        ref="showDatePicker"
                                                        v-model="showDatePicker"
                                                        :close-on-content-click="false"
                                                        transition="scale-transition"
                                                        offset-y
                                                        min-width="290px"
                                                    >
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                            color="accent"
                                                            label="Tanggal"
                                                            append-icon="mdi-calendar"
                                                            :value="formatDate"
                                                            readonly
                                                            v-on="on"
                                                            :solo="true"
                                                            :clearable="true"
                                                            @click:clear="uploadBeritaAcara.date = null"
                                                            class="mt-4 mb-n8"
                                                            :rules="rules.date"
                                                            ></v-text-field>
                                                        </template>
                                                        <v-date-picker v-model="uploadBeritaAcara.date"  no-title scrollable :weekday-format="dayFormat" @change="showDatePicker = false">
                                                        </v-date-picker>
                                                    </v-menu>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-dialog
                                                        ref="dialog"
                                                        v-model="showTimePicker"
                                                        :return-value.sync="uploadBeritaAcara.time"
                                                        persistent
                                                        width="290px"
                                                        style="z-index:9999"
                                                    >
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                            :solo="true"
                                                            v-model="uploadBeritaAcara.time"
                                                            label="Waktu"
                                                            append-icon="mdi-clock-outline"
                                                            readonly
                                                            v-on="on"
                                                            :clearable="true"
                                                            @click:clear="uploadBeritaAcara.time = ''"
                                                            :rules="rules.time"
                                                            ></v-text-field>
                                                        </template>
                                                        <v-time-picker
                                                            v-if="showTimePicker"
                                                            v-model="uploadBeritaAcara.time"
                                                            full-width
                                                        >
                                                        <v-spacer></v-spacer>
                                                            <v-btn text color="primary" @click="showTimePicker = false">Cancel</v-btn>
                                                            <v-btn text color="primary" @click="$refs.dialog.save(uploadBeritaAcara.time)">OK</v-btn>
                                                        </v-time-picker>
                                                    </dialog>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-file-input
                                                        v-model="uploadBeritaAcara.file"
                                                        color="blue"
                                                        label="Berkas Berita Acara"
                                                        prepend-icon=''
                                                        placeholder="Select your file"
                                                        outlined
                                                        append-icon="mdi-file"
                                                        accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                        class="mt-n5"
                                                        :rules="rules.file"
                                                    >
                                                    </v-file-input>
                                                </v-col>
                                            </v-form>
                                            <v-card-actions>
                                                <v-container>
                                                    <v-row justify="center">
                                                        <v-btn class="mt-n8" color="red darken-1" text @click="close">Cancel</v-btn>
                                                        <v-btn class="mt-n8" color="green white--text" @click="uploadBeritaAcaraAction">Upload</v-btn>
                                                    </v-row>
                                                </v-container>
                                            </v-card-actions>
                                        </v-card-text>
                                    </v-card>
                                </v-dialog>
                                <v-dialog persistent v-model="changePasswordOpenDialog" max-width="700px">
                                    <v-card>
                                        <v-toolbar dense flat color="blue">
                                            <span class="title font-weight-light">Ganti Password</span>
                                            <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-form ref="formPassword" class="px-2">
                                            <v-card-text>
                                                <v-row>
                                                    <v-col>
                                                    <v-col cols="12">
                                                        <v-text-field
                                                            v-model="passwordAfter"
                                                            label="Password Baru"
                                                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                            :type="showPassword ? 'text' : 'password'"
                                                            @click:append="showPassword = !showPassword"
                                                            :rules='rules.passwordAfter'
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-text-field
                                                            v-model="passwordAfterConfirmation"
                                                            label="Konfirmasi Password"
                                                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                            :type="showPassword ? 'text' : 'password'"
                                                            @click:append="showPassword = !showPassword"
                                                            :rules='rules.passwordConfirm'
                                                        ></v-text-field>
                                                    </v-col>
                                                </v-row>
                                            </v-card-text>
                                        </v-form>
                                        <v-card-actions>
                                            <v-container>
                                                <v-row justify="center">
                                                    <v-btn class="mt-n8" color="red darken-1" text @click="close">Cancel</v-btn>
                                                    <v-btn class="mt-n8" color="green white--text" @click="changePassword">Change Password</v-btn>
                                                </v-row>
                                            </v-container>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
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

				mounted() {
					this.get()
				},

				data() {
					return {
                        // Dialog goes here
                        uploadBerkasDialog: false,
                        uploadBeritaAcaraDialog: false,
                        showDatePicker:false,
                        showTimePicker:false,
                        changePasswordOpenDialog: false,
                        // Data preparation for JSON
                        uploadBerkas: {
                            toefl:null,
                            transkrip:null,
                            fileSkripsi:null,
                            bimbingan:null
                        },
                        berkass:[],
                        self:{},
                        uploadBeritaAcara: {
                            id_mahasiswa:'<?=$id;?>',
                            file:null,
                            date:null,
                            time:null,
                            id_dosen_pembimbing:null,
                            id_ketua_penguji:null,
                            id_dosen_penguji:null
                        },
                        passwordAfter:'',
                        passwordAfterConfirmation:'',
                        // Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // Rules
                        rules: {
                            date: [
								v => !!v || 'Tanggal Wajib Diisi',
							],
                            time: [
								v => !!v || 'Jam Wajib diisi',
							],
                            file: [
                                v => !!v || 'File is required',
                            ],
                            passwordAfter: [
								v => !!v || 'Password Wajib diisi',
                                v => v == this.passwordAfter || 'Password Konfirmasi Harus Sama Dengan Password Baru',
								v => v.length>=8 || 'Minimal 8 Karakter',
							],
							passwordConfirm: [
								v => !!v || 'Password Wajib diisi',
                                v => v == this.passwordAfter || 'Password Konfirmasi Harus Sama Dengan Password Baru',
							]
                        },
                        // etc
                        uploadLogo: {
                            before:'mdi-upload',
                            in:'mdi-loading mdi-spin',
                            done:'mdi-check',
                            error:'mdi-close',
                            errorColor:'red',
                            doneColor:'green',
                            beforeColor:'white'
                        },
                        logoOne: {
                            logo:'mdi-upload',
                            color:'white'
                        },
                        logoTwo: {
                            logo:'mdi-upload',
                            color:'white'
                        },
                        logoThree: {
                            logo:'mdi-upload',
                            color:'white'
                        },
                        logoFour: {
                            logo:'mdi-upload',
                            color:'white'
                        },
                        showPassword: false,
					}
				},

				methods: {
                    get() {
                        return new Promise((resolve, reject) => {
                            axios.get('<?= base_url()?>api/Berkas',{params: {id_mahasiswa: <?=$id?>}})
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        })
                        .then((response) => {
                            this.berkass = response
                        })
                        .then(() => {
                            return new Promise((resolve, reject) => {
                                axios.get('<?= base_url()?>api/User',{params: {id: <?=$id?>}})
                                    .then(response => {
                                        resolve(response.data)
                                    }) .catch(err => {
                                        if(err.response.status == 500) reject('Server Error')
                                    })
                            })
                            .then((response) => {
                                this.self = response
                                this.uploadBeritaAcara.id_dosen_pembimbing = response[0].id_dosen_pembimbing
                                this.uploadBeritaAcara.id_ketua_penguji = response[0].id_ketua_penguji
                                this.uploadBeritaAcara.id_dosen_penguji = response[0].id_dosen_penguji
                            })
                        })
                    },
                    dayFormat(date) {
						let i = new Date(date).getDay(date)
						var dayOftheWeek = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
						return dayOftheWeek[i]
					},
                    uploadOne() {
                        if(this.$refs.form.validate()) {
                            this.logoOne.logo = this.uploadLogo.in
                            return new Promise((resolve, reject) => {
                                const dataOne = new FormData()
                                dataOne.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                                dataOne.append('file',this.uploadBerkas.toefl)
                                dataOne.append('id',this.berkass[0].id)
                                dataOne.append('which_one','toefl')
                                axios.post(
                                    '<?= base_url()?>api/Berkas',
                                    dataOne,
                                    {headers: {'Content-Type': 'multipart/form-data'}}
                                )
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                    if(err.response.status == 401) reject(err.response.data)
                                })
                            })
                            .then(() => {
                                this.logoOne.logo = this.uploadLogo.done
                                this.logoOne.color = this.uploadLogo.doneColor
                            }) .catch((err) => {
                                if(err.message == "ONLY ACCEPT PDF FILE TYPE") {
                                    this.logoOne.logo = this.uploadLogo.error
                                    this.logoOne.color = this.uploadLogo.errorColor
                                }
                            }) .finally(() => {
                                this.get()
                            })
                        }
                    },
                    uploadTwo() {
                        this.logoTwo.logo = this.uploadLogo.in
                        return new Promise((resolve, reject) => {
                            const dataTwo = new FormData()
                            dataTwo.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataTwo.append('file',this.uploadBerkas.fileSkripsi)
                            dataTwo.append('id',this.berkass[0].id)
                            dataTwo.append('which_one','skripsi')
                            axios.post(
                                '<?= base_url()?>api/Berkas',
                                dataTwo,
                                {headers: {'Content-Type': 'multipart/form-data'}}
                            )
                            .then((response) => {
                                resolve(response.data)
                            }) .catch(err => {
                                if(err.response.status == 500) reject('Server Error')
                                if(err.response.status == 401) reject(err.response.data)
                            })
                        })
                        .then(() => {
                            this.logoTwo.logo = this.uploadLogo.done
                            this.logoTwo.color = this.uploadLogo.doneColor
                        }) .catch((err) => {
                            if(err.message == "ONLY ACCEPT PDF FILE TYPE") {
                                this.logoTwo.logo = this.uploadLogo.error
                                this.logoTwo.color = this.uploadLogo.errorColor
                            }
                        }) .finally(() => {
                            this.get()
                        })
                    },
                    uploadThree() {
                        this.logoThree.logo = this.uploadLogo.in
                        return new Promise((resolve, reject) => {
                            const dataThree = new FormData()
                            dataThree.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataThree.append('file',this.uploadBerkas.bimbingan)
                            dataThree.append('id',this.berkass[0].id)
                            dataThree.append('which_one','bimbingan')
                            axios.post(
                                '<?= base_url()?>api/Berkas',
                                dataThree,
                                {headers: {'Content-Type': 'multipart/form-data'}}
                            )
                            .then((response) => {
                                resolve(response.data)
                            }) .catch(err => {
                                if(err.response.status == 500) reject('Server Error')
                                if(err.response.status == 401) reject(err.response.data)
                            })
                        })
                        .then(() => {
                            this.logoThree.logo = this.uploadLogo.done
                            this.logoThree.color = this.uploadLogo.doneColor
                        }) .catch((err) => {
                            if(err.message == "ONLY ACCEPT PDF FILE TYPE") {
                                this.logoThree.logo = this.uploadLogo.error
                                this.logoThree.color = this.uploadLogo.errorColor
                            }
                        }) .finally(() => {
                            this.get()
                        })
                    },
                    uploadFour() {
                        this.logoFour.logo = this.uploadLogo.in
                        return new Promise((resolve, reject) => {
                            const dataFour = new FormData()
                            dataFour.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataFour.append('file',this.uploadBerkas.transkrip)
                            dataFour.append('id',this.berkass[0].id)
                            dataFour.append('which_one','transkrip')
                            axios.post(
                                '<?= base_url()?>api/Berkas',
                                dataFour,
                                {headers: {'Content-Type': 'multipart/form-data'}}
                            )
                            .then((response) => {
                                resolve(response.data)
                            }) .catch(err => {
                                if(err.response.status == 500) reject('Server Error')
                                if(err.response.status == 401) reject(err.response.data)
                            })
                        })
                        .then(() => {
                            this.logoFour.logo = this.uploadLogo.done
                            this.logoFour.color = this.uploadLogo.doneColor
                        }) .catch((err) => {
                            if(err.message == "ONLY ACCEPT PDF FILE TYPE") {
                                this.logoFour.logo = this.uploadLogo.error
                                this.logoFour.color = this.uploadLogo.errorColor
                            }
                        }) .finally(() => {
                            this.get()
                        })
                    },
                    uploadBeritaAcaraAction() {
                        if(this.$refs.form.validate()) {
                            return new Promise(( resolve, reject) => {
                                const data = new FormData()
                                data.append('id_mahasiswa',this.uploadBeritaAcara.id_mahasiswa)
                                data.append('file',this.uploadBeritaAcara.file)
                                data.append('date',this.uploadBeritaAcara.date)
                                data.append('time',this.uploadBeritaAcara.time)
                                data.append('id_dosen_pembimbing',this.uploadBeritaAcara.id_dosen_pembimbing)
                                data.append('id_ketua_penguji',this.uploadBeritaAcara.id_ketua_penguji)
                                data.append('id_dosen_penguji',this.uploadBeritaAcara.id_dosen_penguji)
                                data.append('max_revisi',moment(this.uploadBeritaAcara.date).add('days', 14).format('YYYY-MM-DD'))
                                axios.post('<?= base_url()?>api/Berita_Acara',data,{headers: {'Content-Type': 'multipart/form-data'}})
                                    .then((response) => {
                                        resolve(response.data)
                                    }) .catch((err) => {
                                        if(err.response.status == 500) reject(err.response.data)
                                    })
                            })
                            .then((response) => {
                                this.snackbarMessage = response.message
                                this.snackbarColor = 'success'
                            }) .catch(err => {
                                this.snackbarMessage = err
                                this.snackbarColor = 'error'
                            }) .finally(() => {
                                this.snackbar = true
                                this.get()
                                this.close()
                            })
                        }
                    },
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    close() {
                        if(this.uploadBerkasDialog) {
                            this.uploadBerkasDialog = false
                        } else {
                            if(this.uploadBeritaAcaraDialog) {
                                this.uploadBeritaAcaraDialog = false
                            } else {
                                if(this.changePasswordOpenDialog) {
                                    this.changePasswordOpenDialog = false
                                    this.passwordAfter = ''
                                    this.passwordAfterConfirmation = ''
                                }
                            }
                        }
                    },
                    changePasswordOpenDialogFunc() {
                        this.changePasswordOpenDialog = true
                    },
                    changePassword() {
                        if(this.$refs.formPassword.validate()) {
                            return new Promise((resolve, reject) => {
                                let data = {
                                    id: <?=$id;?>,
                                    password: this.passwordAfter
                                }
                                axios.put('<?= base_url()?>api/User', data)
                                    .then(response => {
                                                resolve(response.data)
                                            }) .catch(err => {
                                                if(err.response.status == 500) reject(err.response.data)
                                            })
                            })
                            .then((response) => {
                                this.snackbarMessage = response.message
                                this.snackbarColor = 'success'
                            }) .catch(err => {
                                this.snackbarMessage = err
                                this.snackbarColor = 'error'
                            }) .finally(() => {
                                this.snackbar = true
                                this.get()
                                this.close()
                            })
                        }
                    }
				},
				
				computed: {
                    disabledOne() {
                        if(this.berkass.length != 0) {
                            if(this.berkass[0].toefl_file != null){
                                this.logoOne.logo = this.uploadLogo.done
                                this.logoOne.color = this.uploadLogo.doneColor
                                return true
                            }
                        } else {
                            if(this.logoOne.logo != this.uploadLogo.before) {
                                return true
                            }
                        }return false
                    },
                    disabledTwo() {
                        if(this.berkass.length != 0) {
                            if(this.berkass[0].skripsi_file != null){
                                this.logoTwo.logo = this.uploadLogo.done
                                this.logoTwo.color = this.uploadLogo.doneColor
                                return true
                            }
                        } else {
                            if(this.logoTwo.logo != this.uploadLogo.before) {
                                return true
                            }
                        }return false
                    },
                    disabledThree() {
                        if(this.berkass.length != 0) {
                            if(this.berkass[0].bimbingan_file != null){
                                this.logoThree.logo = this.uploadLogo.done
                                this.logoThree.color = this.uploadLogo.doneColor
                                return true
                            }
                        } else {
                            if(this.logoThree.logo != this.uploadLogo.before) {
                                return true
                            }
                        }return false
                    },
                    disabledFour() {
                        if(this.berkass.length != 0) {
                            if(this.berkass[0].transkrip_file != null){
                                this.logoFour.logo = this.uploadLogo.done
                                this.logoFour.color = this.uploadLogo.doneColor
                                return true
                            }
                        } else {
                            if(this.logoFour.logo != this.uploadLogo.before) {
                                return true
                            }
                        }return false
                    },
                    formatDate() {
						return this.uploadBeritaAcara.date ? moment(this.uploadBeritaAcara.date).format('DD MMMM YYYY') : ''
					},
					//view Breakpoint
                    popUpBreakPoint() {
                        if (this.$vuetify.breakpoint.name == 'xs') {
                            return true
                        } else {
                            return false
                        }
                    }
				},

				watch: {
					
				}

			})
		</script>
	</body>

</html>
