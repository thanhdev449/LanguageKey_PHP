<template>
    <div class="">
        <div class="row">
            <div class="col-2">
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
            <div class="table-list col-9">
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
                            <td>Shanny Monahanadsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsds</td>
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
.table-list {
    position: relative;
    overflow-x: scroll;
}

.table {
    position: absolute;
}
</style>
