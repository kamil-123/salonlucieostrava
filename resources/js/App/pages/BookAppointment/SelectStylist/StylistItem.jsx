import React from 'react';

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
			<div className={isActive ? 'isActive' : '' } onClick={this.setStylist}>
				<img src={'http://placehold.it/200x200'} />
				<div>{user.first_name} {user.last_name}</div>				
				<div>{service}</div>
			</div>
		)
	}
}

export default StylistItem;