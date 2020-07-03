<template>
    <div class="TopHearder">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Hidden brand</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <!-- <a class="nav-link" href="/creator">Home <span class="sr-only">(current)</span></a> -->
                        <router-link class="nav-link" to="/creator">Creator <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="/creator/list">List</a> -->
                        <router-link class="nav-link" to="/creator/list">List</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "TopHeader",
    props: {
        msg: String
    }
};
</script>
<style>
#nav {
    padding: 0;
}
</style>
