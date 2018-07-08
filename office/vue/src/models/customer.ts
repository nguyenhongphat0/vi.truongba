export default interface Customer {
    id: number;
    name: string;
    organization: string;
    phone: string;
    address: string;
    date_created: Date;
    description: string;
    email: string;
    avatar: string;
}

import Header from './header'

export const CustomerHeader: Header[] = [
    {
        text: 'Name',
        value: 'name',
    } as Header,
    {
        text: 'Organization',
        value: 'organization',
        align: 'center'
    } as Header,
    {
        text: 'Phone',
        value: 'phone',
        align: 'center'
    } as Header,
    {
        text: 'Address',
        value: 'Address',
        align: 'center'
    } as Header
]