<?php require('template/header.php'); ?>
    <title>Home</title>
    </head>
	<body>
		<div id="app">
			<v-app>
				<?php require('template/navbar.php') ?>
				<v-content>
					<v-layout align-center fill-height>
                        <v-container fluid>
                            <v-row align="center" justify="center">
                                <span class="headline">
                                    PENDAFTARAN TIDAK DIBUKA
                                </span>
                            </v-row>
                        </v-container>
                    </v-layout>
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
					}
				},

				methods: {
                    logOut() {
                        window.location.href = '<?=base_url('Pages/logOut');?>'
                    }
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
				}

			})
		</script>
	</body>

</html>
