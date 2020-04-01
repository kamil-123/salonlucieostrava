import React from 'react';

import Calendar from './Calendar';
import ChooseService from './ChooseService';
import Finish from './Finish';
import SelectStylist from './SelectStylist';


import './BookAppointment.scss';

class BookAppointment extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			currentStep: 0,
			form: {
				stylist_id: null,
				customer_id: null,
				treatment_id: null,
				start_at: null,
				availability: null,
				email: null,
				phoneNumber: null,
				firstName: null,
				lastName: null
			}
		}
	}

	renderStep = () => {
		switch (this.state.currentStep) {
			case 0: return <SelectStylist stylist_id={this.state.form.stylist_id} setStylist={this.setStylist} />;
			case 1: return <ChooseService stylist_id={this.state.form.stylist_id} setService={this.setService} />;
			case 2: return <Calendar setDate={this.setDate} />;
			case 3: return <Finish />;
		}
	}

	setStylist = (stylist_id) => {
		const form = this.state.form;
		this.setState({
			form: {
				...form,
				stylist_id: stylist_id
			}
		});
	}

	setService = (treatment_id) => {
		const form = this.state.form;
		this.setState({
			form: {
				...form,
				treatment_id: treatment_id
			}
		});
	}

	setDate = (start_at) => {
		const form = this.state.form;
		this.setState({
			form: {
				...form,
				start_at: start_at
			}
		});
	}

	// setTimeSlot = (availability) => {
	// 	const form = this.state.form;
	// 	this.setState({
	// 		form: {
	// 			...form,
	// 			availability: availability
	// 		}
	// 	});
	// }

	nextStep = () => {
		this.setState({ currentStep: this.state.currentStep + 1 });
	}

	previousStep = () => {
		this.setState({ currentStep: this.state.currentStep - 1 });
	}

	render() {
		return (
			<div>
				
				<div className="book-appointment-title">Book Appointments</div>
				{this.renderStep()}
				<div className="bottom-container">
					{this.state.currentStep === 0 && <h3> 1 of 4 </h3>}
					{this.state.currentStep === 1 && <h3> 2 of 4 </h3>}
					{this.state.currentStep === 2 && <h3> 3 of 4 </h3>}
					{this.state.currentStep === 3 && <h3> 4 of 4 </h3>}
					<div className="buttons-container">
						{this.state.currentStep !== 0 && <button className="prev-button" onClick={this.previousStep}>Previous</button>}
						{this.state.currentStep !== 3 && <button className="next-button" onClick={this.nextStep}>Next</button>}
					</div>
				</div>
			</div>
		);
	}

}

export default BookAppointment;

