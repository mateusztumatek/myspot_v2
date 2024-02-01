import {reactive, computed, ref} from 'vue'
import Request from "@/plugins/request";
import {RequestError} from "@/plugins/requestError";


export default (url: string, method: 'get' | 'post' = 'get') => {
    const state = reactive({
        data: {},
        totalItems: 0,
        currentPage: 1,
        totalPages: 1,
        perPage: 10,
    })

    const validationErrors = ref(null as RequestError | null);
    const loading = ref(false);

    const getters = reactive({
        isNextPage: computed(() => state.currentPage < state.totalPages),
        isPrevPage: computed(() => state.currentPage > 1)
    })

    /* Get/refresh data from api */
    const makeCall = (params = {}) => {
        loading.value = true;
        validationErrors.value = null;
        return Request({
            url: url,
            method: method,
            data: {...params, ...{page: state.currentPage, per_page: state.perPage}}
        })
            .then((response) => {
                state.data = response;
            }).catch((errors) => {
                if(errors.validationError){
                    validationErrors.value = errors.validationError;
                }
            })
            .finally(() => {
                loading.value = false;
            })
    }

    /* Change page and get data for it */
    const changePage = (page: number) => {
        state.currentPage = page
        return makeCall()
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
        makeCall,
        changePage,
        nextPage,
        prevPage,
        validationErrors
    }
}