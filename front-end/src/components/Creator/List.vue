<template>
    <div class="container-fluid">
        <div class="creator-table">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 form-search">
                        <div class="card text-black bg-light">
                            <div class="card-header">
                                <b>{{ title }}</b>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="fullName" class="float-left">FullName</label>
                                        <input type="text" class="form-control" id="fullName" v-model="params.fullName" aria-describedby="emailHelp" placeholder="full name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="float-left">Email</label>
                                        <input type="email" class="form-control" id="email" v-model="params.email" aria-describedby="emailHelp" placeholder="email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="float-left">Country</label>
                                        <input type="text" class="form-control" id="address" v-model="params.country" placeholder="country" />
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary float-right" v-on:click="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-list col-lg-10">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>FullName</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Country</th>
                                    <th>Score</th>
                                    <th>words</th>
                                    <th>Level</th>
                                    <th>Subcriber</th>
                                    <th>Follower</th>
                                    <th>Role</th>
                                    <th>Avatar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item of resData" v-bind:key="item.id">
                                    <td>{{ item.full_name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.birthday }}</td>
                                    <td>{{ item.country }}</td>
                                    <td>{{ item.score }}</td>
                                    <td>{{ item.words }}</td>
                                    <td>{{ item.level }}</td>
                                    <td>{{ item.subcriber }}</td>
                                    <td>{{ item.follower }}</td>
                                    <td>{{ item.role }}</td>
                                    <td>{{ item.avatar == null ? "" : item.avatar }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <b-pagination v-if="resData.length > 0" v-model="currentPage" :total-rows="rows" :per-page="params.pageLimit" aria-controls="my-table"></b-pagination>
            <!-- <nav aria-label="Page navigation pagination-list">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </div>
</template>

<script>
import { ResfullServiceFactory } from "./../../shared/service/ResfullServiceFactory";
const resApi = ResfullServiceFactory.get("creator");
export default {
    name: "ListCreator",
    props: "",
    data: function() {
        return {
            title: " Action with Creator ",
            resData: [],
            params: {
                email: "",
                fullName: "",
                country: "",
                pageLimit: 5
            },
            currentPage: 1,
            lastPage: 0
        };
    },
    mounted() {
        console.log("first");
    },
    methods: {
        submit() {
            resApi
                .listandFindCreator(this.params)
                .then(res => {
                    if (res.data.success) {
                        this.resData = res.data.data.data;
                        this.lastPage = res.data.data.last_page;
                        console.log(res.data.data);
                    } else {
                        alert(res.data.error);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
<style>
.creator-table {
    overflow: hidden;
}

.table-list {
    position: relative;
    overflow: auto;
    height: fit-content;
}
.pagination-list {
    margin-top: 25px;
}
.form-search {
    padding: 0;
}
.card {
    border-radius: 0;
}

.card-body {
    padding: 1.25rem 0.5rem;
}

/* table {
    overflow: scroll;
} */
</style>
