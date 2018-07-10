export default interface User {
    id: number;
    username: string;
    password: string;
    email: string;
    is_admin: '1' | '';
}