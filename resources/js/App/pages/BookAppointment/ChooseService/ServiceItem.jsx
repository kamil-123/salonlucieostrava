import React from 'react';

class ServiceItem extends React.Component {

	setService = () => {
		const {id} = this.props;
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
			<div className={isActive ? 'isActive' : '' } onClick={this.setService}>
			
				<div>{name} {price} {duration}</div>				
			</div>
		)
	}
}

export default ServiceItem;