export class RequestError implements RequestValidationError{

    public errors;
    public message;
    constructor(errors : any, message : string) {
        this.errors = errors;
        this.message = message;
    }

    getMessage() : string{
        return this.message;
    }
    getErrors(key: string): string[] {
        return this.errors[key] ?? [];
    }

    hasError(key: string): boolean {
        return false;
    }
}
