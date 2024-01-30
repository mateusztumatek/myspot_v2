import {reactive, computed, ref} from 'vue'
import Request from "@/plugins/request";


export default (url: string, method: 'get' | 'post' = 'get') => {
    const state = reactive({
        data: {},
        totalItems: 0,
        currentPage: 1,
        totalPages: 1,
        perPage: 10,
    })

    const loading = ref(false);

    const getters = reactive({
        isNextPage: computed(() => state.currentPage < state.totalPages),
        isPrevPage: computed(() => state.currentPage > 1),
    })

    /* Get/refresh data from api */
    const fetchData = (params = {}) => {
        loading.value = true;
        return Request({
            url: url,
            method: method,
            data: {...params, ...{page: state.currentPage, per_page: state.perPage}}
        })
            .then((response) => {
                state.data = response;
            })
            .finally(() => {
                loading.value = false;
            })
    }

    /* Change page and get data for it */
    const changePage = (page: number) => {
        state.currentPage = page
        return fetchData()
    }

    const nextPage = () => {
        if (getters.isNextPage) {
            changePage(state.currentPage + 1)
        }
    }

    const prevPage = () => {
        if (getters.isPrevPage) {
            changePage(state.currentPage - 1)
        }
    }

    return {
        state,
        loading,
        getters,
        fetchData,
        changePage,
        nextPage,
        prevPage,
    }
}