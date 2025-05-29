// global-types.d.ts

import {Ref} from "vue";
import {Permission} from "@/types/permissions";

declare global {
    type User = {
        id : number | null
        name: string,
        email: string,
        email_verified_at: string | null,
        permissions: Permission[]
    }

    interface RequestValidationError {
        hasError(key : string) : boolean,
        getErrors(key : string) : string[],
        getMessage() : string
    }

}
export {};