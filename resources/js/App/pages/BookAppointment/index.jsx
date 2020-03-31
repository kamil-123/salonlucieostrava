import React from 'react';

import Calendar from './Calendar';
import ChooseService from './ChooseService';
import Finish from './Finish';
import SelectStylist from './SelectStylist';

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
				availability: null
			}
		}
	}

	renderStep = () => {
		switch (this.state.currentStep) {
			case 0: return <SelectStylist stylist_id={this.state.stylist_id} setStylist={this.setStylist} />;
			case 1: return <ChooseService stylist_id={this.state.stylist_id} setService={this.setService} />;
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
				
				{this.renderStep()}
				
				<div>
					<button onClick={this.previousStep}>Previous</button>
					<button onClick={this.nextStep}>Next</button>
				</div>
			</div>
		);
	}

}

export default BookAppointment;

