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
                                                            color="blue"
                                                            label="File input 1"
                                                            placeholder="Select your file 1"
                                                            prepend-icon=""
                                                            append-outer-icon="mdi-upload"
                                                            @click:append-outer="close"
                                                            outlined
                                                            :rules="rules.file"
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-4"
                                                        ></v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            color="blue"
                                                            label="File input 2"
                                                            placeholder="Select your file 2"
                                                            prepend-icon=""
                                                            append-outer-icon="mdi-upload"
                                                            @click:append-outer="close"
                                                            outlined
                                                            :rules="rules.file"
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                        ></v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            color="blue"
                                                            label="File input 3"
                                                            placeholder="Select your file 3"
                                                            prepend-icon=""
                                                            append-outer-icon="mdi-upload"
                                                            @click:append-outer=""
                                                            outlined
                                                            :rules="rules.file"
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                        >
                                                            <template v-slot:append-outer>
                                                                <v-icon>mdi-upload</v-icon>
                                                            </template>
                                                        </v-file-input>
                                                    </v-form>
                                                </v-col>
                                                <v-col cols='12'>
                                                    <v-form ref='form'>
                                                        <v-file-input
                                                            color="blue"
                                                            label="File input 4"
                                                            placeholder="Select your file 4"
                                                            prepend-icon=""
                                                            append-outer-icon="mdi-upload"
                                                            @click:append-outer=""
                                                            outlined
                                                            :rules="rules.file"
                                                            :show-size="1000"
                                                            accept="application/pdf"
                                                            class="mt-n5"
                                                        ></v-file-input>
                                                    </v-form>
                                                </v-col>
                                            </v-card-text>
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

				// mounted() {
				// 	this.get()
				// },

				data() {
					return {
                        // Dialog goes here
                        uploadBerkasDialog: false,
                        // Data preparation for JSON
                        uploadBerkas: {
                            toefl:'',
                            transkrip:'',
                            fileSkripsi:''
                        },
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
					}
				},

				methods: {
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
