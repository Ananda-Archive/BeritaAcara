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
                        // Search goes here
                        searchMahasiswa:'',
                        listBeritaAcara: [],
                        // Snackbar goes here
                        snackbar: false,
                        snackbarMessage: '',
                        snackbarColor: '',
                        // etc
					}
				},

				methods: {
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
                        })
                    },
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    },
                    close() {
                        if(this.uploadBerkasDialog) {
                            this.uploadBerkasDialog = false
                        }
                    },
                    dateFormat(val) {
                        return val ? moment(val).format('DD MMMM YYYY') : ''
                    },
                    timeFormat(val) {
                        return val.substr(0,5)
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
                    }
				}

			})
		</script>
	</body>

</html>
