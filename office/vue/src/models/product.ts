export default interface Product {
    id: number;
    name: string;
    description: string;
    customer_id: number;
    date_created: Date;
    image: string;
    secret: string;
    secret_key: string;
    status: string;
}

import Header from './header'

export const ProductHeader: Header[] = [
    {
        text: 'Name',
        value: 'name',
    } as Header,
    {
        text: 'Description',
        value: 'description',
        align: 'center'
    } as Header,
    {
        text: 'Status',
        value: 'status',
        align: 'center'
    } as Header,
    {
        text: 'Date created',
        value: 'date_created',
        align: 'center'
    } as Header
]