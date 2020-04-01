import React from 'react';

import './StylistItem.scss'


class StylistItem extends React.Component {
	
	setStylist = () => {
		const {id} = this.props;
		this.props.setStylist(id);
	}

		render() {
			const {
				id,
				user_id,
				profile_photo_url,
				job_title,
				introduction,
				service,
				user,
				isActive
			} = this.props;
			return (
			<div className={`stylist-item ${isActive ? 'active' : ''}`} onClick={this.setStylist}>
				<img className="stylist-icon" src={'../../'}  />
				<div className="stylist-name">{user.first_name} {user.last_name}</div>				
				<div className="stylist-service">{service}</div>
				
			</div>
		)
	}
}

export default StylistItem;