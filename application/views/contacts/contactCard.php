<div id="viewCon">
	<div id="myModal" class="modal d-block position-relative">
		<div class="modal-dialog">
			<div class="modal-content contact-content" style="width: 750px; margin-left: -125px;">
				<div class="modal-header contact-header">
					<h3>Contacts</h3>
				</div>
				<div class="modal-body">
					<?php if ($listOfContacts != NULL) : ?>
						<div class="table-responsive">
							<!--					<div id="viewCon">-->
							<table class="table table-hover table-sm contact-table">
								<?php foreach ($listOfContacts as $contact) : ?>
									<tr class="table-light">
										<td>
											<?php echo $contact->getFirstName() . ' ' . $contact->getLastName(); ?>
										</td>
										<td>
											<?php echo $contact->getEmail() ?>
										</td>
										<td>
											<?php echo $contact->getTelephoneNo() ?>
										</td>
										<?php echo form_open(''); ?>
										<td>
											<?php if ($this->session->userdata('userId') == $contact->getUserId()) : ?>

												<input type="hidden" name="contactId"
													   id="<?php echo $contact->getContactId(); ?>"
													   value="<?php echo $contact->getContactId(); ?>">

												<button type="submit" class="editContact-btn"
														id="<?php echo $contact->getContactId() ?>"><i
														class="fa fa-edit fa-2x"></i></button>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($this->session->userdata('userId') == $contact->getUserId()) : ?>

												<input type="hidden" name="contactId"
													   id="<?php echo $contact->getContactId(); ?>"
													   value="<?php echo $contact->getContactId(); ?>">

												<button type="submit" class="deleteContact-btn"
														id="<?php echo $contact->getContactId() ?>"><i
														class="fa fa-trash fa-2x"></i></button>
											<?php endif; ?>
										</td>
										<?php echo form_close(); ?>
									</tr>
								<?php endforeach; ?>
							</table>
							<!--					</div>-->
						</div>
						<br>
					<?php endif; ?>
				</div>
				<div class="modal-footer">
					<button type="submit" class="addContact-btn" id="addContact">New Contact</button>
				</div>
			</div>
		</div>
	</div>

	<?php echo form_open(''); ?>
	<div id="addContactModel" style="display: none;">
		<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content signup-content">
					<div class="modal-header signup-header">
						<h3>Create New Contact</h3>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-md-5">
								<input type="text" class="form-control" name="firstName" id="firstName"
									   placeholder="First name">
							</div>

							<div class="col-md-7">
								<input type="text" class="form-control" name="lastName" id='lastName'
									   placeholder="Last name">
							</div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="email" id="email" placeholder="Email">
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="telephoneNo" id="telephoneNo"
								   placeholder="Telephone Number">
						</div>

						<button type="submit" class="btn btn-primary btn-block" id="createContact" name="createContact">
							Create
							Contact
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

	<?php form_open(''); ?>
	<div id="editContactModel" style="display: none;">
		<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content signup-content">
					<div class="modal-header signup-header">
						<h3>Update Contact</h3>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-md-5">
								<input type="text" class="form-control" name="editFirstName" id="editFirstName"
									   placeholder="First name">
							</div>

							<div class="col-md-7">
								<input type="text" class="form-control" name="editLastName" id='editLastName'
									   placeholder="Last name">
							</div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="editEmail" id="editEmail" placeholder="Email">
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="editTelephoneNo" id="editTelephoneNo"
								   placeholder="Telephone Number">
							<input type="hidden" class="form-control" name="editContactId" id="editContactId">
						</div>

						<div class="form-group">
							<label>Contact Tags</label>
							<select multiple="multiple" class="form-control" name="contactTags"
									id="contactTags">
								<option value="family">Family</option>
								<option value="friend">Friend</option>
								<option value="work">Work</option>
								<option value="school">School</option>
							</select>
						</div>

						<button type="submit" class="btn btn-primary btn-block" id="updateContact" name="updateContact">
							Update Contact
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<script>
	$(document).ready(function () {
		$("#createContact").click(function (event) {
			event.preventDefault();

			var firstName = $("input#firstName").val();
			var lastName = $("input#lastName").val();
			var email = $("input#email").val();
			var telephoneNo = $("input#telephoneNo").val();

			$.ajax({

				url: "<?php echo site_url(); ?>/contactApi/contact",
				method: "POST",
				dataType: "json",
				data: {
					firstName: firstName, lastName: lastName, email: email, telephoneNo: telephoneNo
				}

			}).done(function (data) {

				// $('#contact-table tr').remove(); // clear table for new result
				// var contacts = data;
				// var i;
				// for (i = 0; i < contacts.length; i++) {
				// 	contact = contacts[i];
				// 	var tr = "<tr class=\"table-light\"><td>contact->firstName</td></tr>";
				// 	$('#contact-table').append(tr);
				// }

				$("#viewCon").load(location.href + "#viewCon");

				$("#addContactModel").hide();

				$("input#firstName").val("");
				$("input#lastName").val("");
				$("input#email").val("");
				$("input#telephoneNo").val("");
			});
		});
	});


	$(document).ready(function () {
		var buttons = document.getElementsByClassName('deleteContact-btn');

		for (var i in Object.keys(buttons)) {
			buttons[i].onclick = function (event) {
				event.preventDefault();

				var contactId = this.id;

				$.ajax({

					method: "DELETE",
					url: "<?php echo site_url(); ?>/contactApi/contact/" + contactId,
					dataType: 'JSON',
					data: {
						contactId: contactId
					},
					success: function (data) {
						$("#viewCon").load(location.href + "#viewCon");
					}
				});
			};
		}
	});

	$(document).ready(function () {
		var buttons = document.getElementsByClassName('editContact-btn');

		for (var i in Object.keys(buttons)) {
			buttons[i].onclick = function (event) {
				event.preventDefault();

				var contactId = this.id;
				$("input#editContactId").val(this.id);

				$.ajax({

					method: "GET",
					url: "<?php echo site_url(); ?>/contactApi/contact/" + contactId,
					dataType: 'JSON',
					data: {
						contactId: contactId
					},
					success: function (data) {

						$.each(data, function (contactId, firstName, lastName, email, telephoneNo, displayPictureUrl) {

							$("#editContactModel").show();
							$("#addContactModel").hide();

							$("input#editFirstName").val(firstName[1]);
							$("input#editLastName").val(firstName[2]);
							$("input#editEmail").val(firstName[3]);
							$("input#editTelephoneNo").val(firstName[4]);
						});
					}
				});
			};
		}
	});

	$(document).ready(function () {
		$("#updateContact").click(function (event) {
			event.preventDefault();

			var contactId = $("input#editContactId").val();
			var firstName = $("input#editFirstName").val();
			var lastName = $("input#editLastName").val();
			var email = $("input#editEmail").val();
			var telephoneNo = $("input#editTelephoneNo").val();

			var contactTags = $('#contactTags').val();

			$.ajax({

				method: "PUT",
				url: "<?php echo site_url(); ?>/contactApi/contact/" + contactId,
				dataType: 'JSON',
				data: {
					firstName: firstName,
					lastName: lastName,
					email: email,
					telephoneNo: telephoneNo,
					contactTags: contactTags
				},
				success: function (data) {
					$("#viewCon").load(location.href + "#viewCon");
					$("#editContactModel").hide();
				}
			});
		});
	});

	/**
	 * on click function to load the add contact model
	 */
	$(document).ready(function () {
		$("#addContact").click(function (event) {
			event.preventDefault();

			$("#addContactModel").show();
			$("#editContactModel").hide();

		});
	});
</script>
