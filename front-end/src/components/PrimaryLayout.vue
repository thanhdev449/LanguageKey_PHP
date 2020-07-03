<template>
    <div class="PrimaryLayout">
        <!-- <TopHeader /> -->
        <SideNav />
        <router-view />
    </div>
</template>

<script>
// import TopHeader from "../components/layout/TopHeader";
import SideNav from "../components/layout/SideNav";
export default {
    name: "PrimaryLayout",
    components: {
        // TopHeader,
        SideNav
    }
};
</script>

<style>
#nav {
    padding: 0;
}
</style>
