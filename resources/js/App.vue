<template>
    <el-row :gutter="20">
        <el-col :xs="{span: 24}" :sm="{span: 3}" :md="{span: 6}"></el-col>
        <el-col :xs="{span: 24}" :sm="{span: 18}" :md="{span: 12}">
            <search-form @completed="showResults"></search-form>
            <flats :list="list" :found="found"></flats>
        </el-col>
        <el-col :xs="{span: 24}" :sm="{span: 3}" :md="{span: 6}"></el-col>
    </el-row>
</template>

<script>
import SearchForm from "./components/SearchForm.vue";
import Flats from "./components/Flats.vue";

export default {
    data() {
        return {
            found: false,
            list: [],
        }
    },
    name: "App",
    components: {SearchForm, Flats},
    methods: {
        showResults(list = []) {
            this.list = list;
            this.found = true;
        }
    }
}
</script>

<style>

</style>
