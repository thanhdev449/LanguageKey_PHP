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
                                        <input type="text" class="form-control" id="fullName" aria-describedby="emailHelp" placeholder="full name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="float-left">Email</label>
                                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="float-left">Address</label>
                                        <input type="text" class="form-control" id="address" placeholder="Address" />
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
                                <tr>
                                    <td>Shanny sssssss</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                    <td>Shanny Monahan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation pagination-list">
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
            </nav>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ListCreator",
    props: "",
    data: function() {
        return {
            title: " Action with Creator "
        };
    },
    methods: {
        submit() {
            axios.get("https://localhost:8080/api/creator/list").then(res => {
                console.log(res.data);
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
