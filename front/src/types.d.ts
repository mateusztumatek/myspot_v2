// global-types.d.ts

declare global {
    type User = {
        name: String,
        email: String
    }

    interface RequestValidationError {
        hasError(key : string) : boolean,
        getErrors(key : string) : string[],
    }
}
export {};