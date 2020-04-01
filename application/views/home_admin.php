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
                                    <v-card @click="verifikasiDialog = !verifikasiDialog" class="elevation-12 align-center" color="blue" min-height="230" max-height="230">
                                        <div class="d-flex flex-no-wrap justify-space-between">
											<div>
												<v-card-title class="font-weight-light">VERIFIKASI MAHASISWA</v-card-title>
											</div>
											<div>
												<v-card-title class="font-weight-light"><v-icon>mdi-format-list-checks</v-icon></v-card-title>
											</div>
										</div>
										<v-card-title class="justify-center"><v-icon class="display-4">mdi-account-check</v-icon></v-card-title>
                                    </v-card>
                                </v-col>
								<v-dialog v-model='verifikasiDialog' fullscreen hide-overlay transition="dialog-bottom-transition">
									<v-card>
										<v-toolbar dense flat color="blue">
											<span class="title font-weight-light">Verifikasi Mahasiswa</span>
											<v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
										</v-toolbar>
										<v-card-text>
											<v-data-table
												:headers="verifikasiHeader"
												:items="listUnverifiedUsers"
												:mobile-breakpoint="1"
												item-key="id"
												show-select
												v-model="selectedForVerify"
											>
											</v-data-table>
											<v-card-actions>
                                                <v-container>
													<v-row justify="center">
														<v-col sm="8" md="4" xl="2" class='text-center'>
															<v-btn color="green white--text" width='100%' :disabled="selectedForVerify.length == 0" @click="verifyNow">Aktifkan Akun</v-btn>
														</v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-actions>
										</v-card-text>
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
						// Dialog
						verifikasiDialog: false,
						// Json
						listUnverifiedUsers: [],
						selectedForVerify: [],
						// Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
					}
				},

				methods: {
					get() {
						return new Promise((resolve, reject) => {
                            axios.get('<?= base_url()?>api/User',{params: {verif: 1}})
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        })
                        .then((response) => {
                            this.listUnverifiedUsers = response
                        })
					},
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
					verifyNow() {
						return new Promise((resolve, reject) => {
							let data = {
								users: this.selectedForVerify
							}
                            axios.put('<?= base_url()?>api/Admin',data)
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then((response) => {
                            this.snackbarMessage = response.message
                            this.snackbarColor = 'success'
                        }) .catch(err => {
                            this.snackbarMessage = err
                            this.snackbarColor = 'error'
                        }) .finally(() => {
                            this.snackbar = true
                            this.get()
                        })
					}
				},
				
				computed: {
                    popUpBreakPoint() {
                        if (this.$vuetify.breakpoint.name == 'xs') {
                            return true
                        } else {
                            return false
                        }
                    },
					verifikasiHeader() {
						return [
							{text:'NIM', value:'nomor'},
							{text:'Nama', value:'nama'},
						]
					}
				}

			})
		</script>
	</body>

</html>
