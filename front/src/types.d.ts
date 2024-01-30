// global-types.d.ts

import {Ref} from "vue";

declare global {
    type User = {
        id : number | null
        name: String,
        email: String,
        email_verified_at: string | null
    }

    interface RequestValidationError {
        hasError(key : string) : boolean,
        getErrors(key : string) : string[],
        getMessage() : string
    }

}
export {};