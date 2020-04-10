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
                                                            accept="application/pdf"
                                                            class="mt-4"
                                                            :clearable="logoOne.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon v-if="berkass[0].toefl_file == null || berkass[0].toefl_file_verified == 0" small class="red--text mr-2">mdi-record</v-icon>
                                                                <v-icon @click="uploadOne" :color="logoOne.color">{{logoOne.logo}}</v-icon>
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
                                                            :clearable="logoTwo.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon v-if="berkass[0].skripsi_file == null || berkass[0].skripsi_file_verified_dosen_pembimbing == 0 || berkass[0].skripsi_file_verified_ketua_penguji == 0 || berkass[0].skripsi_file_verified_dosen_penguji == 0" small class="red--text mr-2">mdi-record</v-icon>
                                                                <v-icon @click="uploadTwo" :color="logoTwo.color">{{logoTwo.logo}}</v-icon>
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
                                                            :clearable="logoThree.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon v-if="berkass[0].bimbingan_file == null || berkass[0].bimbingan_file_verified == 0" small class="red--text mr-2">mdi-record</v-icon>
                                                                <v-icon @click="uploadThree" :color="logoThree.color">{{logoThree.logo}}</v-icon>
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
                                                            :clearable="logoFour.logo == uploadLogo.before"
                                                        >
                                                            <template v-slot:append>
                                                                <v-icon v-if="berkass[0].transkrip_file == null || berkass[0].transkrip_file_verified == 0" small class="red--text mr-2">mdi-record</v-icon>
                                                                <v-icon @click="uploadFour" :color="logoFour.color">{{logoFour.logo}}</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                            </v-card-text>
                                            <v-divider class="mt-n8"></v-divider>
                                            <v-card-actions v-if="!popUpBreakPoint">
                                                <v-container>
                                                    <v-row justify="center">
                                                        <v-btn width="30%" :disabled="berkass[0].skripsi_file_revisi_dosen_pembimbing == null" class="mr-4" color="blue white--text" @click="getBerkasDosenPembimbing">Revisi Dosen Pembimbing</v-btn>
                                                        <v-btn width="30%" :disabled="berkass[0].skripsi_file_revisi_ketua_penguji == null" class="mr-4" color="blue white--text" @click="getBerkasKetuaPenguji">Revisi Ketua Penguji</v-btn>
                                                        <v-btn width="30%" :disabled="berkass[0].skripsi_file_revisi_dosen_penguji == null" color="blue white--text" @click="getBerkasDosenPenguji">Revisi Dosen Penguji</v-btn>
                                                    </v-row>
                                                </v-container>
                                            </v-card-actions>
                                            <v-card-actions v-else>
                                                <v-container>
                                                    <v-row justify="center">
                                                        <v-btn width="90%" :disabled="berkass[0].skripsi_file_revisi_dosen_pembimbing == null" class="mb-4" color="blue white--text" @click="getBerkasDosenPembimbing">Revisi Dosen Pembimbing</v-btn>
                                                        <v-btn width="90%" :disabled="berkass[0].skripsi_file_revisi_ketua_penguji == null" class="mb-4" color="blue white--text" @click="getBerkasKetuaPenguji">Revisi Ketua Penguji</v-btn>
                                                        <v-btn width="90%" :disabled="berkass[0].skripsi_file_revisi_dosen_penguji == null" color="blue white--text" @click="getBerkasDosenPenguji">Revisi Dosen Penguji</v-btn>
                                                    </v-row>
                                                </v-container>
                                            </v-card-actions>
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
                                <!-- Upload Undangan -->
                                <v-col cols='12' sm='12' md='3'>
                                    <v-card @click="uploadBimbinganDialog = !uploadBimbinganDialog" class="elevation-12 align-center" color="blue" min-height="230" max-height="230">
                                        <div class="d-flex flex-no-wrap justify-space-between">
											<div>
												<v-card-title class="font-weight-light">UPLOAD UNDANGAN</v-card-title>
											</div>
											<div>
												<v-card-title class="font-weight-light"><v-icon>mdi-file-check</v-icon></v-card-title>
											</div>
										</div>
										<v-card-title class="justify-center"><v-icon class="display-4">mdi-file-account</v-icon></v-card-title>
                                    </v-card>
                                </v-col>
                                <v-dialog persistent v-model="uploadBimbinganDialog" max-width="900px">
                                    <v-card>
                                        <v-toolbar dense flat color="blue">
                                            <span class="title font-weight-light">Upload Undangan</span>
                                            <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card-text>
                                            <v-col cols='12'>
                                                <v-form ref='form'>
                                                    <v-file-input
                                                        v-model="undanganFile"
                                                        color="blue"
                                                        label="Surat Undangan"
                                                        placeholder="Select your file"
                                                        prepend-icon=""
                                                        outlined
                                                        :rules="rules.file"
                                                        accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf"
                                                        class="mt-4"
                                                    >
                                                </v-form>
                                                <v-card-actions>
                                                        <v-row justify="center">
                                                            <v-btn class="my-n4" color="red darken-1" text @click="close">Cancel</v-btn>
                                                            <v-btn class="my-n4" color="green white--text" @click="uploadUndangan">Upload</v-btn>
                                                        </v-row>
                                                </v-card-actions>
                                            </v-col>
                                        </v-card-text>
                                    </v-card>
                                </v-dialog>
                                <!-- DETAIL -->
                                <v-col cols='12' sm='12' md='3'>
                                    <v-card @click="detailDialog = !detailDialog" class="elevation-12 align-center" color="blue" min-height="230" max-height="230">
                                        <div class="d-flex flex-no-wrap justify-space-between">
											<div>
												<v-card-title class="font-weight-light">DETAIL</v-card-title>
											</div>
											<div>
												<v-card-title class="font-weight-light"><v-icon>mdi-account-circle</v-icon></v-card-title>
											</div>
										</div>
										<v-card-title class="justify-center"><v-icon class="display-4">mdi-account-details</v-icon></v-card-title>
                                    </v-card>
                                </v-col>
                                <v-dialog persistent v-model="detailDialog" max-width="900px">
                                    <v-card>
                                        <v-toolbar dense flat color="blue">
                                            <span class="title font-weight-light">Details</span>
                                            <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card-text class='mt-4'>
                                            <v-simple-table>
                                                <template v-slot:default>
                                                    <tbody>
                                                        <tr>
                                                            <td class="font-weight-bold">NIM</td>
                                                            <td>{{self.nomor}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">NAMA</td>
                                                            <td>{{self.nama}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">JUDUL SKRIPSI</td>
                                                            <td>{{self.judul}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">DOSEN PEMBIMBING</td>
                                                            <td>
                                                                <v-row>
                                                                    <v-col cols='11'>
                                                                        {{self.nama_dosen_pembimbing}}
                                                                    </v-col>
                                                                    <v-spacer></v-spacer>
                                                                    <v-col cols='1'>
                                                                        <v-tooltip bottom>
                                                                            <template v-slot:activator="{ on }">
                                                                                <v-icon color="blue" v-on="on" :disabled="self.jadwal_dosen_pembimbing == null" @click="getJadwalPembimbing">mdi-calendar-clock</v-icon>
                                                                            </template>
                                                                            <span>Download Jadwal</span>
                                                                        </v-tooltip>
                                                                    </v-col>
                                                                </v-row>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">KETUA PENGUJI</td>
                                                            <td v-if="self.id_ketua_penguji != null">
                                                                <v-row>
                                                                    <v-col cols='11'>
                                                                        {{self.nama_ketua_penguji}}
                                                                    </v-col>
                                                                    <v-spacer></v-spacer>
                                                                    <v-col cols='1'>
                                                                        <v-tooltip bottom>
                                                                            <template v-slot:activator="{ on }">
                                                                                <v-icon color="blue" v-on="on" :disabled="self.jadwal_ketua_penguji == null" @click="getJadwalKetua">mdi-calendar-clock</v-icon>
                                                                            </template>
                                                                            <span>Download Jadwal</span>
                                                                        </v-tooltip>
                                                                    </v-col>
                                                                </v-row>
                                                            </td>
                                                            <td v-else>-</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-weight-bold">DOSEN PENGUJI 1</td>
                                                            <td v-if="self.id_dosen_penguji != null">
                                                                <v-row>
                                                                    <v-col cols='11'>
                                                                        {{self.nama_dosen_penguji}}
                                                                    </v-col>
                                                                    <v-spacer></v-spacer>
                                                                    <v-col cols='1'>
                                                                        <v-tooltip bottom>
                                                                            <template v-slot:activator="{ on }">
                                                                                <v-icon color="blue" v-on="on" :disabled="self.jadwal_dosen_penguji == null" @click="getJadwalPenguji">mdi-calendar-clock</v-icon>
                                                                            </template>
                                                                            <span>Download Jadwal</span>
                                                                        </v-tooltip>
                                                                    </v-col>
                                                                </v-row>
                                                            </td>
                                                            <td v-else>-</td>
                                                        </tr>
                                                    </tbody>
                                                </template>
                                            </v-simple-table>
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
                        uploadBerkasDialog: false,
                        uploadBeritaAcaraDialog: false,
                        showDatePicker:false,
                        showTimePicker:false,
                        changePasswordOpenDialog: false,
                        detailDialog: false,
                        uploadBimbinganDialog: false,
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
                        undanganFile: null,
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
                    getBerkasDosenPembimbing() {
                        window.open(this.berkass[0].skripsi_file_revisi_dosen_pembimbing, '_blank');
                    },
                    getBerkasKetuaPenguji() {
                        window.open(this.berkass[0].skripsi_file_revisi_ketua_penguji, '_blank');
                    },
                    getBerkasDosenPenguji() {
                        window.open(this.berkass[0].skripsi_file_revisi_dosen_penguji, '_blank');
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
                    uploadUndangan() {
                        if(this.$refs.form.validate()) {
                            return new Promise( (resolve, reject) => {
                                const data  = new FormData()
                                data.append('id_dosen_pembimbing',this.self.id_dosen_pembimbing)
                                data.append('id_ketua_penguji',this.self.id_ketua_penguji)
                                data.append('id_dosen_penguji',this.self.id_dosen_penguji)
                                data.append('file',this.undanganFile)
                                axios.post('<?= base_url()?>api/Post_Undangan',data,{headers: {'Content-Type': 'multipart/form-data'}})
                                    .then((response) => {
                                        resolve(response.data)
                                    }) .catch((err) => {
                                        if(err.response.status == 500) reject(err.response.data)
                                    })
                            } )
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
                                } else {
                                    if(this.detailDialog) {
                                        this.detailDialog = false
                                    } else {
                                        if(this.uploadBimbinganDialog) {
                                            this.undanganFile = null
                                            this.uploadBimbinganDialog = false
                                        }
                                    }
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
                    },
                    getJadwalPembimbing() {
                        window.open(this.self.jadwal_dosen_pembimbing, '_blank');
                    },
                    getJadwalKetua() {
                        window.open(this.self.jadwal_ketua_penguji, '_blank');
                    },
                    getJadwalPenguji() {
                        window.open(this.self.jadwal_dosen_penguji, '_blank');
                    },
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
