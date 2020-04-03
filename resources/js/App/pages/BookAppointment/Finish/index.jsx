import React from 'react';
import moment from 'moment';
import './Finish.scss'
export default class Finish extends React.Component {

    render() {
        const { form, makeAppointment } = this.props;
        const { 
            startAt,
            firstName,
            email,
            phoneNumber,
            stylist: { user },
            treatment: { name }
        } = form;

        const stylistName = `${user.first_name} ${user.last_name}`;

        return (
            <div className='finish-container'>
                <div className='finish1'>Dear {firstName}, here are your booking details: </div>
                <div className='details-container'>
                    <div><span className="details">Treatment:</span> {name}</div>
                    <div><span className="details">Stylist:</span> {stylistName}</div>
                    <div><span className="details">Your email:</span> {email}</div>
                    <div><span className="details">Your phone number:</span> {phoneNumber}</div>
                    <div className="details-at"><span className="details">At</span> {moment(startAt).format('dddd DD-MM HH:mm')}</div>
                </div>
                <button className="button-appointment" onClick={makeAppointment}>Make Appointment</button>
            </div>
        )
    }

}