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
                            <v-row align="center" justify="center">
                                <v-col md="10" sm="12">
                                    <!-- search -->
                                    <v-text-field
                                        placeholder="NIM / Nama Mahasiswa"
                                        :solo='true'
                                        :clearable='true'
                                        append-icon="mdi-magnify"
                                        class="font-regular font-weight-light mb-n4"
                                        v-model="searchMahasiswa"
                                    ></v-text-field>
                                    <!-- Tabel Mahasiswa -->
                                    <v-data-table
                                        :headers="listUndanganHeader"
                                        :items="listSuratUndangan"
                                        :search="searchMahasiswa"
                                        style="cursor:pointer"
                                        :mobile-breakpoint="1"
                                        @click:row="detail"
                                    >
                                    </v-data-table>
                                    <v-dialog persistent max-width="700px" v-model="detailDialog">
                                        <v-card>
                                            <v-toolbar dense flat color="blue">
                                                <span class="title font-weight-light">Detail Mahasiswa</span>
                                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                            </v-toolbar>
                                            <v-card-text class="mt-4">
                                                <v-simple-table>
                                                    <template v-slot:default>
                                                        <tbody>
                                                            <tr>
                                                                <td class="font-weight-bold">NIM</td>
                                                                <td>{{suratUndangan.user.nomor}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">Nama</td>
                                                                <td>{{suratUndangan.user.nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">Dosen Pembimbing</td>
                                                                <td>{{suratUndangan.dosen_pembimbing.nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">Ketua Penguji</td>
                                                                <td>{{suratUndangan.ketua_penguji.nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">Dosen Penguji 1</td>
                                                                <td>{{suratUndangan.dosen_penguji.nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">Surat Undangan</td>
                                                                <td><v-icon @click="getUndanganFile" color="blue">mdi-file</v-icon></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-container>
                                                    <v-row justify="center">
                                                        <v-col cols='4' class='text-center mt-n8'>
                                                            <v-btn color="red white--text" :disabled="disabled" width='100%' @click="decline"><v-icon>mdi-close</v-icon></v-btn>
                                                        </v-col>
                                                        <v-col cols='4' class='text-center  mt-n8'>
                                                            <v-btn color="green white--text" :disabled="disabled" width='100%' @click="accept"><v-icon>mdi-check</v-icon></v-btn>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-actions>
                                            <v-progress-linear
                                                :active="loading"
                                                :indeterminate="loading"
                                                absolute
                                                bottom
                                                color="blue"
                                            ></v-progress-linear>
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
                        detailDialog: false,
                        // Search goes here
                        searchMahasiswa: '',
                        // JSON goes here
                        listSuratUndangan: [],
                        suratUndangan: {},
						// Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // etc
                        disabled:false,
                        loading: false,
                        selectedIndex: -1,
					}
				},

				methods: {
                    get() {
                        return new Promise((resolve, reject) => {
                            axios.get('<?= base_url()?>api/Post_Undangan')
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        })
                        .then((response) => {
                            this.listSuratUndangan = response
                        })
                    },
                    getUndanganFile() {
                        window.open(this.suratUndangan.file, '_blank');
                    },
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    detail(item) {
                        this.selectedIndex = this.listSuratUndangan.indexOf(item)
                        this.suratUndangan = Object.assign({},item)
                        this.detailDialog = true
                    },
                    close() {
                        if(this.detailDialog) {
                            this.detailDialog = false
                            this.suratUndangan = {}
                        }
                    },
                    decline() {
                        this.disabled = true
                        this.loading = true
                        return new Promise((resolve, reject) => {
                            let data = {
                                id:this.suratUndangan.id,
                                status:0,
                            }
                            axios.put('<?= base_url()?>api/Post_Undangan',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
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
                            this.close()
                            this.disabled = false
                            this.loading = false
                        })
                    },
                    accept() {
                        this.disabled = true
                        this.loading = true
                        return new Promise((resolve, reject) => {
                            let data = {
                                id:this.suratUndangan.id,
                                file:this.suratUndangan.file,
                                status:1,
                                email_dosen_pembimbing:this.suratUndangan.dosen_pembimbing.email,
                                email_ketua_penguji:this.suratUndangan.ketua_penguji.email,
                                email_dosen_penguji:this.suratUndangan.dosen_penguji.email,
                            }
                            axios.put('<?= base_url()?>api/Post_Undangan',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
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
                            this.close()
                            this.disabled = false
                            this.loading = false
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
                    listUndanganHeader() {
                        return [
                            {text:'NIM', value:'user.nomor'},
                            {text:'Nama', value:'user.nama'}
                        ]
                    }
				}

			})
		</script>
	</body>

</html>
