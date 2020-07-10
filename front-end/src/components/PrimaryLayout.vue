<template>
    <div class="PrimaryLayout">
        <SideNav />
    </div>
</template>

<script>
// import TopHeader from "../components/layout/TopHeader";
import SideNav from "../components/layout/SideNav";
export default {
    name: "PrimaryLayout",
    components: {
        SideNav
    }
};
</script>

<style>
#nav {
    padding: 0;
}
.PrimaryLayout {
    position: relative;
    /* overflow: hidden; */
}
</style>
