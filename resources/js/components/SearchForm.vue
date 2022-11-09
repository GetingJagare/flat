<template>
    <el-form v-loading="loading" @keydown.enter.prevent="sendFilters">
        <h1>Search Flats</h1>
        <el-row :gutter="20">
            <el-col :xs="{span: 24}" :md="{span: 12}">
                <el-form-item>
                    <el-input v-model="form.name" placeholder="Name"></el-input>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Start Price</label>
                    <el-input-number v-model="form.price_from" min="0" label="Start Price"
                                     placeholder="Start Price"></el-input-number>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>End Price</label>
                    <el-input-number v-model="form.price_to" min="0" label="End Price"
                                     placeholder="End Price"></el-input-number>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Bedroom Count</label>
                    <el-input-number v-model="form.bedrooms" min="0" label="Bedroom Count"
                                     placeholder="Bedroom Count"></el-input-number>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Bathroom Count</label>
                    <el-input-number v-model="form.bathrooms" min="0" label="Bathroom Count"
                                     placeholder="Bathroom Count"></el-input-number>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Storey Count</label>
                    <el-input-number v-model="form.storeys" min="0" label="Storey Count"
                                     placeholder="Storey Count"></el-input-number>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Garage Count</label>
                    <el-input-number v-model="form.garages" min="0" label="Garage Count"
                                     placeholder="Garage Count"></el-input-number>
                </el-form-item>
            </el-col>
        </el-row>
        <el-button type="primary" :icon="Search" @click="sendFilters">Search</el-button>
    </el-form>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            form: {
                name: '',
                price_from: 0,
                price_to: 0,
                bedrooms: 0,
                bathrooms: 0,
                storeys: 0,
                garages: 0,
            }
        }
    },
    name: "SearchForm",
    methods: {
        async sendRequest(url = '', data = {}, method = 'POST') {
            this.loading = true;
            const res = await axios({
                url,
                method,
                data,
            });
            setTimeout(() => {
                this.loading = false;
            }, 500);
            return res.data;
        },
        async sendFilters() {
            const res = await this.sendRequest('/search', this.form);
            this.$emit('completed', res);
        },
    },
}
</script>

<style>
label {
    width: 100%;
}
</style>
