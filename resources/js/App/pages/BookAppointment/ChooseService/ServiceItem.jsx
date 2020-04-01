import React from 'react';
import moment from 'moment';
import './ServiceItem.scss'
class ServiceItem extends React.Component {

	setService = () => {
		const { id } = this.props;
		this.props.setService(id);
	}

	render() {
		const {
			id,
			stylist_id,
			name,
			price,
			duration,
			isActive
		} = this.props;
		return (
			<div className={`service-item ${isActive ? 'active' : ''}`} onClick={this.setService}>

			<div className="service-data">{name} {price} {moment(duration, 'HH:mm:ss').format('H [hrs]')}</div>
			</div>
		)
	}
}

export default ServiceItem;