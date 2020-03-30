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
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            v-model="uploadBerkas.toefl"
                                                            color="blue"
                                                            label="Berkas TOEFL"
                                                            placeholder="Select your file"
                                                            prepend-icon=""
                                                            outlined
                                                            :rules="rules.file"
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-4"
                                                            :disabled="logoOne.logo != uploadLogo.before"
                                                            :clearable="logoOne.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon :color="logoOne.color">{{logoOne.logo}}</v-icon>
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
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                            :disabled="logoTwo.logo != uploadLogo.before"
                                                            :clearable="logoTwo.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon :color="logoTwo.color">{{logoTwo.logo}}</v-icon>
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
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                            :disabled="logoThree.logo != uploadLogo.before"
                                                            :clearable="logoThree.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon :color="logoThree.color">{{logoThree.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-container>
                                                    <v-row justify="center">
                                                        <v-btn class="mt-n12" color="red darken-1" text @click="close">Cancel</v-btn>
                                                        <v-btn class="mt-n12" color="green white--text" @click="uploadBerkasAction">Upload</v-btn>
                                                    </v-row>
                                                </v-container>
										</v-card-actions>
                                        </v-card>
                                    </v-dialog>
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

				mounted() {
					this.get()
				},

				data() {
					return {
                        // Dialog goes here
                        uploadBerkasDialog: false,
                        // Data preparation for JSON
                        uploadBerkas: {
                            toefl:'',
                            transkrip:'',
                            fileSkripsi:'',
                            bimbingan:''
                        },
                        berkass:[],
                        // Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // Rules goes here
                        rules: {
                            file: [
                                v => !!v || 'File is required',
                            ],
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
                        }
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
                    },
                    uploadOne() {
                        this.logoOne.logo = this.uploadLogo.in
                        return new Promise((resolve, reject) => {
                            const dataOne = new FormData()
                            dataOne.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataOne.append('file',this.uploadBerkas.toefl)
                            dataOne.append('id',this.berkass[0].id)
                            dataOne.append('transkrip_file',this.berkass[0].transkrip_file)
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
                    },
                    uploadTwo() {
                        return new Promise((resolve, reject) => {
                            const dataTwo = new FormData()
                            dataTwo.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataTwo.append('file',this.uploadBerkas.fileSkripsi)
                            dataTwo.append('id',this.berkass[0].id)
                            dataTwo.append('transkrip_file',this.berkass[0].transkrip_file)
                            dataTwo.append('which_one','skripsi')
                            dataTwo.append('toefl_file',this.berkass[0].toefl_file)
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
                        return new Promise((resolve, reject) => {
                            const dataThree = new FormData()
                            dataThree.append('id_mahasiswa',this.berkass[0].id_mahasiswa)
                            dataThree.append('file',this.uploadBerkas.bimbingan)
                            dataThree.append('id',this.berkass[0].id)
                            dataThree.append('transkrip_file',this.berkass[0].transkrip_file)
                            dataThree.append('which_one','bimbingan')
                            dataThree.append('toefl_file',this.berkass[0].toefl_file)
                            dataThree.append('skripsi_file',this.berkass[0].skripsi_file)
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
                    uploadBerkasAction() {
                        this.uploadOne()
                        this.uploadTwo()
                        this.uploadThree()
                    },
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    close() {
                        if(this.uploadBerkasDialog) {
                            this.uploadBerkasDialog = false
                        }
                    },
				},
				
				computed: {
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
