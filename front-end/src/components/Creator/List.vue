<template>
    <div class="creator-table">
        <div class="row">
            <div class="col-2">
                <div class="card text-black bg-light">
                    <div class="card-header"><b>List Admin</b></div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="float-left">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="float-left">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                            </div>
                            <button type="submit" class="btn btn-primary float-left">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-list col-10">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>FullName</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Avatar</th>
                            <th>Address</th>
                            <th>Country</th>
                            <th>Score</th>
                            <th>words</th>
                            <th>Level</th>
                            <th>Subcriber</th>
                            <th>Follower</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Shanny ssssssssssssssss</td>
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
                            <td>Shanny Monahan</td>
                            <td>Shanny Monahan</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListCreator"
};
</script>
<style>
.creator-table {
    overflow: hidden;
}

.table-list {
    position: relative;
    overflow: auto;
}

/* table {
    overflow: scroll;
} */
</style>
