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
                                        :headers="mahasiswasHeader"
                                        :items="listBeritaAcara"
                                        :search="searchMahasiswa"
                                        @click:row="details"
                                        style="cursor:pointer"
                                    >
                                        <template v-slot:item.date="{ item }">
                                            <span>{{dateFormat(item.date)}}</span>
                                        </template>
                                        <template v-slot:item.time="{ item }">
                                            <span>{{timeFormat(item.time)}}</span>
                                        </template>
                                    </v-data-table>
                                </v-col>
                                <v-dialog v-model='detailDialog' persistent max-width="1000px">
                                    <v-card>
                                        <v-toolbar dense flat color="blue">
                                            <span class="title font-weight-light">Berita Acara</span>
                                            <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card-text class="mt-4">
                                            <v-simple-table>
                                                <template v-slot:default>
                                                    <tbody>
                                                        <tr>
                                                            <td class="font-weight-bold">NIM</td>
                                                            <td>{{beritaAcara.user[0].nomor}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">NAMA</td>
                                                            <td>{{beritaAcara.user[0].nama}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">JUDUL SKRIPSI</td>
                                                            <td>{{beritaAcara.user[0].judul}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">DOSEN PEMBIMBING</td>
                                                            <td>{{revealDosen(beritaAcara.user[0].id_dosen_pembimbing)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KETUA PENGUJI</td>
                                                            <td>{{revealDosen(beritaAcara.user[0].id_ketua_penguji)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">DOSEN PENGUJI 1</td>
                                                            <td>{{revealDosen(beritaAcara.user[0].id_dosen_penguji)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">BERKAS SKRIPSI</td>
                                                            <td>
                                                                <v-icon @click.stop="goToSkripsi" class='blue--text'>mdi-file</v-icon>
                                                                <span class='mx-4'>||</span>
                                                                <v-icon @click="verify_fail_skripsi" class='mr-4 red--text' :disabled="beritaAcara.berkas[0].skripsi_file_verified == 0">mdi-close</v-icon>
                                                                <v-icon @click="verify_success_skripsi" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified == 1">mdi-check</v-icon>
                                                                <span v-if="beritaAcara.berkas[0].skripsi_file_verified == 1" class="green--text">Lulus</span>
                                                                <span v-if="beritaAcara.berkas[0].skripsi_file_verified == 0" class="red--text">Revisi</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">BERKAS TOEFL</td>
                                                            <td>
                                                                <v-icon @click.stop="goToToefl" class='blue--text'>mdi-file</v-icon>
                                                                <span class='mx-4'>||</span>
                                                                <v-icon @click="verify_fail_toefl" class='mr-4 red--text' :disabled="beritaAcara.berkas[0].toefl_file_verified == 0">mdi-close</v-icon>
                                                                <v-icon @click="verify_success_toefl" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].toefl_file_verified == 1">mdi-check</v-icon>
                                                                <span v-if="beritaAcara.berkas[0].toefl_file_verified == 1" class="green--text">Lulus</span>
                                                                <span v-if="beritaAcara.berkas[0].toefl_file_verified == 0" class="red--text">Revisi</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">TRANSKRIP</td>
                                                            <td>
                                                                <v-icon @click.stop="goToTranskrip" class='blue--text'>mdi-file</v-icon>
                                                                <span class='mx-4'>||</span>
                                                                <v-icon @click="verify_fail_transkrip" class='mr-4 red--text' :disabled="beritaAcara.berkas[0].transkrip_file_verified == 0">mdi-close</v-icon>
                                                                <v-icon @click="verify_success_transkrip" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].transkrip_file_verified == 1">mdi-check</v-icon>
                                                                <span v-if="beritaAcara.berkas[0].transkrip_file_verified == 1" class="green--text">Lulus</span>
                                                                <span v-if="beritaAcara.berkas[0].transkrip_file_verified == 0" class="red--text">Revisi</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KARTU BIMBINGAN</td>
                                                            <td>
                                                                <v-icon @click.stop="goToBimbingan" class='blue--text'>mdi-file</v-icon>
                                                                <span class='mx-4'>||</span>
                                                                <v-icon @click="verify_fail_bimbingan" class='mr-4 red--text' :disabled="beritaAcara.berkas[0].bimbingan_file_verified == 0">mdi-close</v-icon>
                                                                <v-icon @click="verify_success_bimbingan" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].bimbingan_file_verified == 1">mdi-check</v-icon>
                                                                <span v-if="beritaAcara.berkas[0].bimbingan_file_verified == 1" class="green--text">Lulus</span>
                                                                <span v-if="beritaAcara.berkas[0].bimbingan_file_verified == 0" class="red--text">Revisi</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">BERKAS BERITA ACARA</td>
                                                            <td><v-icon @click.stop="goToBeritaAcara" class='blue--text'>mdi-file</v-icon></td>
                                                        </tr>
                                                        <tr v-if="beritaAcara.id_ketua_penguji == id">
                                                            <td class="font-weight-bold">NILAI</td>
                                                            <td class="px-n4">
                                                                <v-text-field
                                                                    style="width:100px"
                                                                    v-model="beritaAcara.nilai"
                                                                    label="nilai"
                                                                    dense
                                                                    outlined
                                                                    class="mb-n6 mt-1"
                                                                ></v-text-field>
                                                            </td>
                                                        </tr>
                                                        <tr v-if="beritaAcara.id_ketua_penguji == id && beritaAcara.status != 'Lulus' && beritaAcara.status != null">
                                                            <td class="font-weight-bold">NILAI FINAL</td>
                                                            <td class="px-n4">
                                                                <v-text-field
                                                                    style="width:100px"
                                                                    v-model="beritaAcara.nilai_final"
                                                                    label="nilai"
                                                                    dense
                                                                    outlined
                                                                    class="mb-n6 mt-1"
                                                                ></v-text-field>
                                                            </td>
                                                        </tr>
                                                        <tr v-if="beritaAcara.id_ketua_penguji == id">
                                                            <td class="font-weight-bold">STATUS</td>
                                                            <td>
                                                                <v-select
                                                                    style="width:160px"
                                                                    :items="listStatus"
                                                                    v-model="beritaAcara.status"
                                                                    label="status"
                                                                    dense
                                                                    outlined
                                                                    class="mb-n6 mt-1"
                                                                ></v-select>
                                                            </td>
                                                        </tr>
                                                        <tr v-if="beritaAcara.status == 'Revisi'">
                                                            <td class="font-weight-bold">Maksimal Revisi</td>
                                                            <td>
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
                                                                        label="Tanggal"
                                                                        append-icon="mdi-calendar"
                                                                        :value="formatDate"
                                                                        readonly
                                                                        v-on="on"
                                                                        outlined
                                                                        dense
                                                                        :clearable="true"
                                                                        @click:clear="beritaAcara.max_revisi = null"
                                                                        class="mb-n6 mt-1"
                                                                        ></v-text-field>
                                                                    </template>
                                                                    <v-date-picker v-model="beritaAcara.max_revisi"  no-title scrollable :weekday-format="dayFormat" @change="showDatePicker = false">
                                                                    </v-date-picker>
                                                                </v-menu>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KOMENTAR</td>
                                                            <td>
                                                                <v-textarea
                                                                    v-model="comment"
                                                                    label="Komentar"
                                                                    :auto-grow="true"
                                                                    outlined
                                                                    dense
                                                                    rows="1"
                                                                    class="mb-n6 mt-1"
                                                                ></v-textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </template>
                                            </v-simple-table>
                                            <v-card-actions>
                                                <v-container>
                                                    <v-row justify="center">
                                                    <v-col cols='4' class='text-center'>
                                                        <v-btn color="orange darken-1" width='100%' :disabled="konfirmasiKehadiranButtonCondition" @click="konfirmasiKehadiran">Konfirmasi Kehadiran</v-btn>
                                                    </v-col>
                                                    <v-col cols='4' class='text-center'>
                                                        <v-btn color="green white--text" width='100%' :disabled="beritaAcaraButtonCondition" @click="finalisasiBeritaAcara">Selesai</v-btn>
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
                        // Dialog goes here
                        detailDialog: false,
                        showDatePicker: false,
                        // Search goes here
                        searchMahasiswa:'',
                        // JSON
                        comment:'',
                        listBeritaAcara: [],
                        listDosen: [],
                        beritaAcara: {
                            id:null,
                            id_mahasiswal:null,
                            file:'',
                            ttd_dosen_pembimbing:null,
                            ttd_ketua_penguji:null,
                            ttd_dosen_penguji:null,
                            nilai:null,
                            nilai_final:null,
                            max_revisi:'',
                            status:null,
                            comment_dosen_pembimbing:null,
                            comment_ketua_penguji:null,
                            comment_dosen_penguji:null
                        },
                        // Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // Rule
                        rules: {
                            nilai: [v => !!v || ''],
                            status: [v => !!v || '']
                        },
                        // etc
                        selectedIndex:-1,
                        id:null,
                        listStatus: ['Revisi','Sidang Ulang','Lulus','Tidak Lulus'],
					}
				},

				methods: {
                    dayFormat(date) {
						let i = new Date(date).getDay(date)
						var dayOftheWeek = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
						return dayOftheWeek[i]
					},
                    verify_success_skripsi() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                skripsi_file_verified: 1,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].skripsi_file_verified = 1
                                this.get()
                            })
                    },
                    verify_fail_skripsi() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                skripsi_file_verified: 0,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].skripsi_file_verified = 0
                                this.get()
                            })
                    },
                    verify_success_toefl() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                toefl_file_verified: 1,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].toefl_file_verified = 1
                                this.get()
                            })
                    },
                    verify_fail_toefl() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                toefl_file_verified: 0,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].toefl_file_verified = 0
                                this.get()
                            })
                    },
                    verify_success_transkrip() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                transkrip_file_verified: 1,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].transkrip_file_verified = 1
                                this.get()
                            })
                    },
                    verify_fail_transkrip() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                transkrip_file_verified: 0,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].transkrip_file_verified = 0
                                this.get()
                            })
                    },
                    verify_success_bimbingan() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                bimbingan_file_verified: 1,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].bimbingan_file_verified = 1
                                this.get()
                            })
                    },
                    verify_fail_bimbingan() {
                        return new Promise((resolve, reject) => {
                            let data = {
                                bimbingan_file_verified: 0,
                                id: this.beritaAcara.berkas[0].id
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
                                .then((response) => {
                                    resolve(response.data)
                                }) .catch((err) => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        }) .then (() => {
                                this.beritaAcara.berkas[0].bimbingan_file_verified = 0
                                this.get()
                            })
                    },
                    goToSkripsi() {
                        window.open(this.beritaAcara.berkas[0].skripsi_file, '_blank');
                    },
                    goToToefl() {
                        window.open(this.beritaAcara.berkas[0].toefl_file, '_blank');
                    },
                    goToTranskrip() {
                        window.open(this.beritaAcara.berkas[0].transkrip_file, '_blank');
                    },
                    goToBimbingan() {
                        window.open(this.beritaAcara.berkas[0].bimbingan_file, '_blank');
                    },
                    goToBeritaAcara() {
                        window.open(this.beritaAcara.file, '_blank');
                    },
                    get() {
                        return new Promise((resolve, reject) => {
                            axios.get('<?= base_url()?>api/Berita_Acara',{params: {id: <?=$id?>}})
                                .then(response => {
                                    resolve(response.data)
                                }) .catch(err => {
                                    if(err.response.status == 500) reject('Server Error')
                                })
                        })
                        .then((response) => {
                            this.listBeritaAcara = response
                            this.id = <?=$id?>
                        })
                        .then(() => {
                            return new Promise((resolve, reject) => {
                                axios.get('<?= base_url()?>api/DosenList')
                                    .then((response) => {
                                        resolve(response.data)
                                    }) .catch((err) => {
                                        if(err.response.status == 500) reject('Server Error')
                                    })
                            })
                            .then((response) => {
                                this.listDosen = response
                            })
                        })
                    },
                    revealDosen(user) {
                        return _.find(this.listDosen,['id',user]).nama
                    },
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    dateFormat(val) {
                        return val ? moment(val).format('DD MMMM YYYY') : ''
                    },
                    timeFormat(val) {
                        return val.substr(0,5)
                    },
                    details(item) {
                        this.selectedIndex = this.listBeritaAcara.indexOf(item)
                        this.beritaAcara = Object.assign({},item)
                        this.detailDialog = true
                    },
                    close() {
                        if(this.detailDialog) {
                            this.detailDialog = false
                            this.selectedIndex = -1
                            this.beritaAcara = {}
                            this.comment = ''
                        }
                    },
                    konfirmasiKehadiran() {
                        return new Promise((resolve, reject) => {
                            if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                                var data = {id: this.beritaAcara.id, ttd_dosen_pembimbing: 1}
                            } else {
                                if(this.id == this.beritaAcara.id_ketua_penguji) {
                                    var data = {id: this.beritaAcara.id, ttd_ketua_penguji: 1}
                                } else {
                                    if(this.id == this.beritaAcara.id_dosen_penguji) {
                                        var data = {id: this.beritaAcara.id, ttd_dosen_penguji: 1}
                                    }
                                }
                            }
                            axios.put('<?= base_url()?>api/Berita_Acara',data)
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
                            if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                                this.beritaAcara.ttd_dosen_pembimbing = 1
                            } else {
                                if(this.id == this.beritaAcara.id_ketua_penguji) {
                                    this.beritaAcara.ttd_ketua_penguji = 1
                                } else {
                                    if(this.id == this.beritaAcara.id_dosen_penguji) {
                                        this.beritaAcara.ttd_dosen_penguji = 1
                                    }
                                }
                            }
                        })
                    },
                    finalisasiBeritaAcara() {
                        if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                            this.beritaAcara.comment_dosen_pembimbing = this.comment
                        } else {
                            if(this.id == this.beritaAcara.id_ketua_penguji) {
                                this.beritaAcara.comment_ketua_penguji = this.comment
                            } else {
                                if(this.id == this.beritaAcara.id_dosen_penguji) {
                                    this.beritaAcara.comment_dosen_penguji = this.comment
                                }
                            }
                        }
                        return new Promise((resolve, reject) => {
                            var data = {
                                id: this.beritaAcara.id,
                                nilai: this.beritaAcara.nilai,
                                nilai_final: this.beritaAcara.nilai_final,
                                status: this.beritaAcara.status,
                                max_revisi: this.beritaAcara.max_revisi,
                                comment_dosen_pembimbing: this.beritaAcara.comment_dosen_pembimbing,
                                comment_ketua_penguji: this.beritaAcara.comment_ketua_penguji,
                                comment_dosen_penguji: this.beritaAcara.comment_dosen_penguji
                            }
                            if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                                data.comment_dosen_pembimbing = this.comment
                            } else {
                                if(this.id == this.beritaAcara.id_ketua_penguji) {
                                    data.comment_ketua_penguji = this.comment
                                } else {
                                    if(this.id == this.beritaAcara.id_dosen_penguji) {
                                        data.comment_dosen_penguji = this.comment
                                    }
                                }
                            }
                            axios.put('<?= base_url()?>api/Berita_Acara',data)
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
                    mahasiswasHeader() {
                        return [
                            {text:'NIM', value:'user[0].nomor'},
                            {text:'Nama', value:'user[0].nama'},
                            {text:'Tanggal', value:'date', filter:() => true},
                            {text:'Jam', value:'time', filter:() => true}
                        ]
                    },
                    formatDate() {
						return this.beritaAcara.max_revisi ? moment(this.beritaAcara.max_revisi).format('DD MMMM YYYY') : ''
					},
                    beritaAcaraButtonCondition() {
                        if(this.detailDialog) {
                            if((this.beritaAcara.nilai == null && this.beritaAcara.id_ketua_penguji == this.id) || (this.beritaAcara.nilai == '' && this.beritaAcara.id_ketua_penguji == this.id) || (this.beritaAcara.status == null && this.beritaAcara.id_ketua_penguji == this.id) || this.beritaAcara.berkas[0].skripsi_file_verified == null || this.beritaAcara.berkas[0].toefl_file_verified == null || this.beritaAcara.berkas[0].transkrip_file_verified == null || this.beritaAcara.berkas[0].bimbingan_file_verified == null) {
                                return true
                            } else {
                                if(this.konfirmasiKehadiranButtonCondition) {
                                    return false
                                } else {
                                    return true
                                }
                            }
                        }
                    },
                    konfirmasiKehadiranButtonCondition() {
                        if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                             if(this.beritaAcara.ttd_dosen_pembimbing == 1) {
                                 return true
                             }
                        } else {
                            if(this.id == this.beritaAcara.id_ketua_penguji) {
                                if(this.beritaAcara.ttd_ketua_penguji == 1) {
                                    return true
                                }
                            } else {
                                if(this.id == this.beritaAcara.id_dosen_penguji) {
                                    if(this.beritaAcara.ttd_dosen_penguji == 1) {
                                        return true
                                    }
                                }
                            }
                        }
                    }
				}

			})
		</script>
	</body>

</html>
