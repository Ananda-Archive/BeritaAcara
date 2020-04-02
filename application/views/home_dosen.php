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
                                <v-dialog v-model="detailsDialog" persistent max-width="1000px">
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
                                                            <td>
                                                                {{revealDosen(beritaAcara.user[0].id_dosen_pembimbing)}}
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_dosen_pembimbing,0)" class="mr-4 red--text" :disabled="beritaAcara.ttd_dosen_pembimbing == 0">mdi-close</v-icon>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_dosen_pembimbing,1)" class="mr-4 green--text" :disabled="beritaAcara.ttd_dosen_pembimbing == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.ttd_dosen_pembimbing == 0" class="red--text">Tidak Hadir</span>
                                                                    <span v-if="beritaAcara.ttd_dosen_pembimbing == 1" class="green--text">Hadir</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KETUA PENGUJI</td>
                                                            <td>
                                                                {{revealDosen(beritaAcara.user[0].id_ketua_penguji)}}
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_ketua_penguji,0)" class="mr-4 red--text" :disabled="beritaAcara.ttd_ketua_penguji == 0">mdi-close</v-icon>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_ketua_penguji,1)" class="mr-4 green--text" :disabled="beritaAcara.ttd_ketua_penguji == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.ttd_ketua_penguji == 0" class="red--text">Tidak Hadir</span>
                                                                    <span v-if="beritaAcara.ttd_ketua_penguji == 1" class="green--text">Hadir</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">DOSEN PENGUJI 1</td>
                                                            <td>
                                                                {{revealDosen(beritaAcara.user[0].id_dosen_penguji)}}
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_dosen_penguji,0)" class="mr-4 red--text" :disabled="beritaAcara.ttd_dosen_penguji == 0">mdi-close</v-icon>
                                                                    <v-icon @click="konfirmasiKehadiran(beritaAcara.user[0].id_dosen_penguji,1)" class="mr-4 green--text" :disabled="beritaAcara.ttd_dosen_penguji == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.ttd_dosen_penguji == 0" class="red--text">Tidak Hadir</span>
                                                                    <span v-if="beritaAcara.ttd_dosen_penguji == 1" class="green--text">Hadir</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">BERKAS SKRIPSI</td>
                                                            <td>
                                                                <v-icon @click.stop="goToSkripsi" class='blue--text'>mdi-file</v-icon>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('skripsi_file_verified_ketua_penguji',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_ketua_penguji == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('skripsi_file_verified_ketua_penguji',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_ketua_penguji == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_ketua_penguji == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_ketua_penguji == 1" class="green--text">Lulus</span>
                                                                </span>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_dosen_pembimbing">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('skripsi_file_verified_dosen_pembimbing',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_dosen_pembimbing == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('skripsi_file_verified_dosen_pembimbing',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_dosen_pembimbing == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_dosen_pembimbing == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_dosen_pembimbing == 1" class="green--text">Lulus</span>
                                                                </span>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_dosen_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('skripsi_file_verified_dosen_penguji',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_dosen_penguji == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('skripsi_file_verified_dosen_penguji',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].skripsi_file_verified_dosen_penguji == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_dosen_penguji == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].skripsi_file_verified_dosen_penguji == 1" class="green--text">Lulus</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">BERKAS TOEFL</td>
                                                            <td>
                                                                <v-icon @click.stop="goToToefl" class='blue--text'>mdi-file</v-icon>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('toefl_file_verified',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].toefl_file_verified == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('toefl_file_verified',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].toefl_file_verified == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].toefl_file_verified == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].toefl_file_verified == 1" class="green--text">Lulus</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">TRANSKRIP</td>
                                                            <td>
                                                                <v-icon @click.stop="goToTranskrip" class='blue--text'>mdi-file</v-icon>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('transkrip_file_verified',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].transkrip_file_verified == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('transkrip_file_verified',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].transkrip_file_verified == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].transkrip_file_verified == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].transkrip_file_verified == 1" class="green--text">Lulus</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KARTU BIMBINGAN</td>
                                                            <td>
                                                                <v-icon @click.stop="goToBimbingan" class='blue--text'>mdi-file</v-icon>
                                                                <span class="mx-4" v-if="id == beritaAcara.id_ketua_penguji">
                                                                    <span class="mr-4">||</span>
                                                                    <v-icon @click="verify('bimbingan_file_verified',0)" class="mr-4 red--text" :disabled="beritaAcara.berkas[0].bimbingan_file_verified == 0">mdi-close</v-icon>
                                                                    <v-icon @click="verify('bimbingan_file_verified',1)" class="mr-4 green--text" :disabled="beritaAcara.berkas[0].bimbingan_file_verified == 1">mdi-check</v-icon>
                                                                    <span v-if="beritaAcara.berkas[0].bimbingan_file_verified == 0" class="red--text">Revisi</span>
                                                                    <span v-if="beritaAcara.berkas[0].bimbingan_file_verified == 1" class="green--text">Lulus</span>
                                                                </span>
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
                                                            <td class="font-weight-bold">UPLOAD REVISI</td>
                                                            <td>
                                                                <v-file-input
                                                                    v-model="file"
                                                                    color="blue"
                                                                    label="Upload Revisi"
                                                                    prepend-icon=""
                                                                    outlined
                                                                    accept="application/pdf"
                                                                    class="mb-n6 mt-1"
                                                                    dense
                                                                >
                                                                <template v-slot:prepend-inner>
                                                                    <v-icon>mdi-paperclip</v-icon>
                                                                </template>
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
                                                        <v-col cols='4' class='text-center mb-n8'>
                                                            <v-btn color="green white--text" width='100%' @click="finalisasiBeritaAcara">Selesai</v-btn>
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
                        showDatePicker: false,
                        detailsDialog: false,
                        // Search goes here
                        searchMahasiswa:'',
                        // JSON
                        file:undefined,
                        listStatus: ['Revisi','Sidang Ulang','Lulus','Tidak Lulus'],
                        listBeritaAcara: [],
                        listDosen: [],
                        beritaAcara: {},
                        // Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // etc
                        id:null,
                        selectedIndex: -1,
                        comment:'',
                        tempUrl:'',
					}
				},

				methods: {
                    dayFormat(date) {
						let i = new Date(date).getDay(date)
						var dayOftheWeek = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
						return dayOftheWeek[i]
					},
                    dateFormat(val) {
                        return val ? moment(val).format('DD MMMM YYYY') : ''
                    },
                    timeFormat(val) {
                        return val.substr(0,5)
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
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    details(item) {
                        this.selectedIndex = this.listBeritaAcara.indexOf(item)
                        this.beritaAcara = Object.assign({},item)
                        this.detailsDialog = true
                    },
                    close() {
                        if(this.detailsDialog) {
                            this.beritaAcara = {}
                            this.detailsDialog = false
                        }
                    },
                    revealDosen(user) {
                        return _.find(this.listDosen,['id',user]).nama
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
                    verify(which_one,is_pass) {
                        return new Promise((resolve, reject) => {
                            if(which_one == 'skripsi_file_verified_dosen_pembimbing' || which_one == 'skripsi_file_verified_ketua_penguji' || which_one == 'skripsi_file_verified_dosen_penguji') {
                                if(this.beritaAcara.user[0].id_dosen_pembimbing == this.id) {
                                    var data = {id: this.beritaAcara.berkas[0].id, skripsi_file_verified_dosen_pembimbing: is_pass}
                                } else {
                                    if(this.beritaAcara.user[0].id_ketua_penguji == this.id) {
                                        var data = {id: this.beritaAcara.berkas[0].id, skripsi_file_verified_ketua_penguji: is_pass}
                                        console.log(data)
                                    } else {
                                        if(this.beritaAcara.user[0].id_dosen_penguji == this.id) {
                                            var data = {id: this.beritaAcara.berkas[0].id, skripsi_file_verified_dosen_penguji: is_pass}
                                        }
                                    }
                                }
                            } else {
                                if(which_one == 'toefl_file_verified') {
                                    var data = {id: this.beritaAcara.berkas[0].id, toefl_file_verified: is_pass}
                                } else {
                                    if(which_one == 'transkrip_file_verified') {
                                        var data = {id: this.beritaAcara.berkas[0].id, transkrip_file_verified: is_pass}
                                    } else {
                                        if(which_one == 'bimbingan_file_verified') {
                                            var data = {id: this.beritaAcara.berkas[0].id, bimbingan_file_verified: is_pass}
                                        }
                                    }
                                }
                            }
                            axios.put('<?= base_url()?>api/Berkas',data)
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
                            if(which_one == 'skripsi_file_verified_dosen_pembimbing' || which_one == 'skripsi_file_verified_ketua_penguji' || which_one == 'skripsi_file_verified_dosen_penguji') {
                                if(this.beritaAcara.user[0].id_dosen_pembimbing == this.id) {
                                    this.beritaAcara.berkas[0].skripsi_file_verified_dosen_pembimbing = is_pass
                                } else {
                                    if(this.beritaAcara.user[0].id_ketua_penguji == this.id) {
                                        this.beritaAcara.berkas[0].skripsi_file_verified_ketua_penguji = is_pass
                                    } else {
                                        if(this.beritaAcara.user[0].id_dosen_penguji == this.id) {
                                            this.beritaAcara.berkas[0].skripsi_file_verified_dosen_penguji = is_pass
                                        }
                                    }
                                }
                            } else {
                                if(which_one == 'toefl_file_verified') {
                                    this.beritaAcara.berkas[0].toefl_file_verified = is_pass
                                } else {
                                    if(which_one == 'transkrip_file_verified') {
                                        this.beritaAcara.berkas[0].transkrip_file_verified = is_pass
                                    } else {
                                        if(which_one == 'bimbingan_file_verified') {
                                            this.beritaAcara.berkas[0].bimbingan_file_verified = is_pass
                                        }
                                    }
                                }
                            }
                        })
                    },
                    konfirmasiKehadiran(which_one,is_coming) {
                        return new Promise((resolve, reject) => {
                            if(this.beritaAcara.user[0].id_dosen_pembimbing == which_one) {
                                var data = {id: this.beritaAcara.id, ttd_dosen_pembimbing: is_coming}
                            } else {
                                if(this.beritaAcara.user[0].id_ketua_penguji == which_one) {
                                    var data = {id: this.beritaAcara.id, ttd_ketua_penguji: is_coming}
                                } else {
                                    if(this.beritaAcara.user[0].id_dosen_penguji == which_one) {
                                        var data = {id: this.beritaAcara.id, ttd_dosen_penguji: is_coming}
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
                            if(this.beritaAcara.user[0].id_dosen_pembimbing == which_one) {
                                this.beritaAcara.ttd_dosen_pembimbing = is_coming
                            } else {
                                if(this.beritaAcara.user[0].id_ketua_penguji == which_one) {
                                    this.beritaAcara.ttd_ketua_penguji = is_coming
                                } else {
                                    if(this.beritaAcara.user[0].id_dosen_penguji == which_one) {
                                        this.beritaAcara.ttd_dosen_penguji = is_coming
                                    }
                                }
                            }
                        })
                    },
                    finalisasiBeritaAcara() {
                        // update berita acara dulu
                        // baru insert file (update ke berkas) kalau ada upload revisi
                        // baru insert new column di berkas kalau revisi
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
                        }) .then(() => {
                            if(this.file != undefined) {
                                return new Promise((resolve, reject) => {
                                    var fileUpload = new FormData()
                                    fileUpload.append('nomor_mahasiswa',this.beritaAcara.user[0].nomor)
                                    fileUpload.append('id',this.beritaAcara.berkas[0].id)
                                    fileUpload.append('file',this.file)
                                    if(this.id == this.beritaAcara.id_dosen_pembimbing) {
                                        fileUpload.append('which_one','revisi_dosen_pembimbing')
                                    } else {
                                        if(this.id == this.beritaAcara.id_ketua_penguji) {
                                            fileUpload.append('which_one','revisi_ketua_penguji')
                                        } else {
                                            if(this.id == this.beritaAcara.id_dosen_penguji) {
                                                fileUpload.append('which_one','revisi_dosen_penguji')
                                            }
                                        }
                                    }
                                    axios.post(
                                        '<?= base_url()?>api/Berkas',
                                        fileUpload,
                                        {headers: {'Content-Type': 'multipart/form-data'}}
                                    )
                                    .then((response) => {
                                        resolve(response.data)
                                    }) .catch(err => {
                                        if(err.response.status == 500) reject('Server Error')
                                    })
                                })
                                .then((response) => {
                                    this.tempUrl = response.message
                                })
                            }
                        }) .then(() => {
                            if(this.beritaAcara.status != 'Lulus' && this.id == this.beritaAcara.id_ketua_penguji) {
                                var dataBerkas = this.beritaAcara.berkas[0]
                                if(dataBerkas.skripsi_file_verified_ketua_penguji != null && dataBerkas.bimbingan_file_verified != null && dataBerkas.transkrip_file_verified != null && dataBerkas.toefl_file_verified != null) {
                                    return new Promise((resolve, reject) => {
                                        if(dataBerkas.skripsi_file_verified_ketua_penguji != 1) {
                                            dataBerkas.skripsi_file_verified_ketua_penguji = null
                                            dataBerkas.skripsi_file = null
                                            dataBerkas.skripsi_file_revisi_ketua_penguji = this.tempUrl
                                        }
                                        if(dataBerkas.toefl_file_verified != 1) {
                                            dataBerkas.toefl_file_verified = null
                                            dataBerkas.toefl_file = null
                                        }
                                        if(dataBerkas.transkrip_file_verified != 1) {
                                            dataBerkas.transkrip_file_verified = null
                                            dataBerkas.transkrip_file = null
                                        }
                                        if(dataBerkas.bimbingan_file_verified != 1) {
                                            dataBerkas.bimbingan_file_verified = null
                                            dataBerkas.bimbingan_file = null
                                        }
                                        axios.post('<?= base_url()?>api/BerkasRevisi',dataBerkas)
                                            .then((response) => {
                                                resolve(response.data)
                                            }) .catch((err) => {
                                                if(err.response.status == 500) reject('Server Error')
                                            })
                                    })
                                }
                            }
                        }) .catch(err => {
                            this.snackbarMessage = err
                            this.snackbarColor = 'error'
                        }) .finally(() => {
                            this.snackbar = true
                            this.file = undefined
                            this.comment = ''
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
				}

			})
		</script>
	</body>

</html>
