import React from 'react';

export default class Finish extends React.Component {

    render() {
        const { form, makeAppointment } = this.props;
        const { 
            name: customerName,
            email,
            phoneNumber,
            stylist: { user },
            treatment: { name, duration, price }
        } = form;

        const stylistName = `${user.firstName} ${user.lastName}`;

        return (
            <div>
                <div>{customerName}</div>
                <div>{phoneNumber}</div>
                <div>{email}</div>
                <div>{stylistName}</div>
                <div>{name}, {duration}, {price}</div>
                <button className="button button-primary" onClick={makeAppointment}>Make Appointment</button>
            </div>
        )
    }

}