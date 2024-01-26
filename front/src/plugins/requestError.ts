export class RequestError implements RequestValidationError{

    public errors;
    constructor(errors : any) {
        this.errors = errors;
    }
    getErrors(key: string): string[] {
        return [];
    }

    hasError(key: string): boolean {
        return false;
    }
}
