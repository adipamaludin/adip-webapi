<template>
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 10px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ judul }}
                    </div>
                    <div class="card-body" v-if="!loading">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button class="form-control btn btn-primary" @click="resetData"> Reset Data</button>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" type="search" v-model="katakunci" placeholder="Masukan Kata Kunci dan Tekan Enter" @change="jalankanPencarian">
                            </div>
                        </div>
                        <hr>
                        <table class="table table-bordered" v-if="!error">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis kelamin</th>
                                    <th>Dibuat pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in konten.data" :key="item.id">
                                    <td>{{ item.nama }}</td>
                                    <td>{{ item.jk }}</td>
                                    <td>{{ item.created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :data="konten" @pagination-change-page="aksesApi">
                            <span slot="prev-nav">&lt; Previous</span>
                            <span slot="next-nav">Next &gt;</span>
                        </pagination>
                        <div v-if="error">
                            {{error}}
                        </div>
                    </div>
                    <div class="card-body" v-if="loading">
                        Loading...
                    </div>
                </div>
                <notifications group="foo" />
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                judul: 'Data Siswa',
                konten: {},
                error: '',
                loading: true,
                katakunci: ''
            }
        },
        mounted() {
            this.aksesApi()
        },
        methods:{
            aksesApi(page= 1, katakunci){
                this.$Progress.start()
                this.Loading = true
                const params = {
                    page: page
                }
                if (katakunci) {
                    params.katakunci = katakunci
                }
                axios.get('/testapi?page=', {params}).then(res => {
                    this.konten = res.data
                    this.loading = false
                    this.$Progress.finish()
                    this.$notify({
                        type: 'bg-success',
                        group: 'foo',
                        title: 'Success',
                        text: 'Berhasil'
                    });
                }).catch(error => {
                    this.null
                    this.loading = false
                    this.$Progress.fail()
                    this.$notify({
                        type: 'bg-danger',
                        group: 'foo',
                        title: 'Error',
                        text: error
                    });
                })
            },
            jalankanPencarian(){
                this.aksesApi(1, this.katakunci)
            },
            resetData(){
                this.katakunci = ''
                this.aksesApi()
            }
        }
    }
</script>
