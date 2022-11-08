<template>
    <el-form v-loading="loading" @keydown.enter.prevent="sendRequest">
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
                    <el-input-number v-model="form.price_from" :min="limits.price_from" label="Start Price"
                                     placeholder="Start Price"></el-input-number>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>End Price</label>
                    <el-input-number v-model="form.price_to" :min="limits.price_from" :max="limits.price_to"
                                     label="End Price" placeholder="End Price"></el-input-number>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Bedroom Count</label>
                    <el-select v-model="form.bedrooms" filterable placeholder="Select">
                        <el-option v-for="n in bedroomRange" :key="`bedroom_count_${n}`" :label="n" :value="n" />
                    </el-select>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Bathroom Count</label>
                    <el-select v-model="form.bathrooms" filterable placeholder="Select">
                        <el-option v-for="n in bathroomRange" :key="`bathroom_count_${n}`" :label="n" :value="n" />
                    </el-select>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Storey Count</label>
                    <el-select v-model="form.storeys" filterable placeholder="Select">
                        <el-option v-for="n in storeyRange" :key="`storey_count_${n}`" :label="n" :value="n" />
                    </el-select>
                </el-form-item>
            </el-col>
            <el-col :xs="{span: 24}" :md="{span: 12}" :lg="{span: 6}">
                <el-form-item>
                    <label>Garage Count</label>
                    <el-select v-model="form.garages" filterable placeholder="Select">
                        <el-option v-for="n in garageRange" :key="`garage_count_${n}`" :label="n" :value="n" />
                    </el-select>
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
            limits: {
                price: {
                    min: 0,
                    max: 0,
                },
                bedrooms: {
                    min: 0,
                    max: 0,
                },
                bathrooms: {
                    min: 0,
                    max: 0,
                },
                storeys: {
                    min: 0,
                    max: 0,
                },
                garages: {
                    min: 0,
                    max: 0,
                },
            },
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
    async mounted() {
        const filterLimits = await this.sendRequest('/filter-limits', {}, 'GET');

        this.limits = {
            ...this.limits,
            ...filterLimits,
        }

        Object.keys(this.form).forEach((k) => {
            this.form[k] = k === 'price_from' ? this.limits.price.min
                : (k === 'price_to' ? this.limits.price.max : (this.limits[k] ? this.limits[k].min : ''));
        });
    },
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
        filterRange(name)
        {
            return new Array(this.limits[name].max - this.limits[name].min + 1)
                .fill(0)
                .map((d, i) => i + this.limits[name].min);
        }
    },
    computed: {
        bedroomRange() {
            return new Array(this.limits['bedrooms'].max - this.limits['bedrooms'].min + 1)
                .fill(0)
                .map((d, i) => i + this.limits['bedrooms'].min);
        },
        bathroomRange() {
            return new Array(this.limits['bathrooms'].max - this.limits['bathrooms'].min + 1)
                .fill(0)
                .map((d, i) => i + this.limits['bathrooms'].min);
        },
        storeyRange() {
            return new Array(this.limits['storeys'].max - this.limits['storeys'].min + 1)
                .fill(0)
                .map((d, i) => i + this.limits['storeys'].min);
        },
        garageRange() {
            return new Array(this.limits['garages'].max - this.limits['garages'].min + 1)
                .fill(0)
                .map((d, i) => i + this.limits['garages'].min);
        }
    }
}
</script>

<style>
label {
    width: 100%;
}
</style>
