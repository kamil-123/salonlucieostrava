import React from 'react';
import axios from 'axios';

import ServiceItem from './ServiceItem';

import './ChooseService.scss';

class ChooseService extends React.Component {
	
	constructor(props) {
		super(props);
		this.state = {
			listOfServices: []
		}
	}

	async componentDidMount() {
		const response = await axios.get(`/api/treatment?stylist_id=${this.props.stylist_id}`);
		const listOfServices = response.data;

		this.setState({ listOfServices:listOfServices });
	}


	render() {
		// console.log(this.state.listOfServices)
		const { setService, service_id } = this.props;
		return (
			<div className="choose-service-container">
				{this.state.listOfServices.map(service => (
					<ServiceItem
						key={service.id}
						id={service.id}
						stylist_id={service.stylist_id}
						name={service.name}
						price={service.price}
						duration={service.duration}
						setService={setService}
						isActive={service.id === service_id}
					/>
				))}
			</div>
		);
	}

}

export default ChooseService;

